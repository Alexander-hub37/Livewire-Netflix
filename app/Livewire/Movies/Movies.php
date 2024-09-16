<?php

namespace App\Livewire\Movies;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Genre;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use App\Livewire\Forms\MovieForm;
use Illuminate\Support\Facades\Storage;


class Movies extends Component
{
    use WithFileUploads;
    use WithPagination;

    public MovieForm $form;  
    public $isEditing = false;
    public $showModal = false;

    
    
    public function create()
    {
        $this->form->create();  
        $this->closeModal();    
        session()->flash('success', 'Movie created successfully!');
    }

    public function edit(Movie $movie)
    {
        $this->form->resetForm();  
        $this->isEditing = true;
        $this->form->fillFromModel($movie);
        $this->showModal = true;
        $this->dispatch('show-tinymce');
    }

   
    public function update()
    {
        $this->form->update();  
        $this->closeModal();    
        session()->flash('success', 'Movie updated successfully!');
    }

    
    public function delete(Movie $movie)
    {
        if ($movie->image) {
            Storage::disk('public')->delete($movie->image);
        }
        $movie->delete();
        session()->flash('success', 'Movie deleted successfully!');
    }

    
    public function showCreateModal()
    {
        $this->form->resetForm();  
        $this->isEditing = false;  
        $this->showModal = true;
        $this->dispatch('show-tinymce');
    }

    public function closeModal()
    {
        $this->form->resetForm();  
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
