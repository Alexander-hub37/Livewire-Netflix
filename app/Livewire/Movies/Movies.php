<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;

class Movies extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title;
    public $description;
    public $image;
    public $selectedGenres = [];
    public $movieId;
    public $isEditing = false;
    public $showModal = false;

    protected $rules = [
        'title' => 'required|string|min:3',
        'description' => 'nullable|required|min:3',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'selectedGenres' => 'required|array'
    ];


    public function create()
    {
        $this->validate();

        $imagePath = $this->image?->store('images','public');

        $movie = Movie::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $movie->genres()->sync($this->selectedGenres);

        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', 'Movie created successfully! ');
    }

    public function edit(Movie $movie)
    {
        $this->resetForm();
        $this->isEditing = true;
        $this->movieId = $movie->id;
        $this->title = $movie->title;
        $this->description = $movie->description;
        $this->selectedGenres = $movie->genres->pluck('id')->toArray();
        $this->showModal = true;
        $this->dispatch('show-tinymce');
    }

    public function update()
    {
        $this->validate();

        $movie = Movie::find($this->movieId);

        if ($this->image) {
            if($movie->image){
                Storage::disk('public')->delete($movie->image);
            }
            $imagePath = $this->image->store('images','public');
        }else{
            $imagePath = $movie->image;
        }

        $movie->update([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $movie->genres()->sync($this->selectedGenres);

        $this->resetForm();
        $this->showModal = false;

        session()->flash('success', 'Movie updated successfully! ');

    }

    public function delete(Movie $movie)
    {
        if($movie->image) {
            Storage::disk('public')->delete($movie->image);
        }
        $movie->delete();

        session()->flash('success', 'Movie deleted successfully! ');
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->dispatch('show-tinymce');
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->showModal = false;
        $this->dispatch('hide-tinymce');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->selectedGenres = [];
        $this->movieId = null;
        $this->isEditing = false;
        $this->showModal = false;
        $this->dispatch('hide-tinymce');
    }

    public function render()
    {
        $genres = Genre::all();
        $movies = Movie::paginate(5);

        return view('livewire.movies.movies', [
            'genres' => $genres,
            'movies' => $movies,
        ]);
    }
}
