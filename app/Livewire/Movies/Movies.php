<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;


class Movies extends Component
{
    use WithFileUploads;

    public $movies;
    public $genres;
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

    public function mount()
    {
        $this->genres = Genre::all();
        $this->movies = Movie::all();
    }

    public function create()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('images','public') : null;

        $movie = Movie::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $movie->genres()->sync($this->selectedGenres);

        $this->resetForm();
        $this->movies = Movie::all();
        $this->showModal = false;

    }

    public function edit($id)
    {
        $this->resetForm();
        $this->isEditing = true;
        $this->movieId = $id;
        $movie = Movie::find($id);
        $this->title = $movie->title;
        $this->description = $movie->description;
        $this->selectedGenres = $movie->genres->pluck('id')->toArray();
        $this->showModal = true;
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
        $this->movies = Movie::all();
        $this->showModal = false;

    }

    public function delete($id)
    {
        $movie = Movie::findOrFail($id);
        if($movie->image) {
            Storage::disk('public')->delete($movie->image);
        }
        $movie->delete();
        $this->movies = Movie::all();
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
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
    }

    public function render()
    {
        return view('livewire.movies.movies');
    }
}
