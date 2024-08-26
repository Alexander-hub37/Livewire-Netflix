<?php

namespace App\Livewire\Genres;

use Livewire\Component;
use App\Models\Genre;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $name;
    public $genreId;
    public $isEditing = false;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|min:3|unique:genres,name',
    ];

    public function create()
    {
        $this->validate();
        Genre::create(['name' => $this->name]);
        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', 'Genre created successfully!');
    }

    public function edit(Genre $genre)
    {
        $this->resetForm();
        $this->isEditing = true;
        $this->genreId = $genre->id;
        $this->name = $genre->name;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $genre = Genre::find($this->genreId);
        $genre->update(['name' => $this->name]);
        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', 'Genre updated successfully!');

    }

    public function delete(Genre $genre)
    {
        $genre->delete();
        session()->flash('success', 'Genre deleted successfully!');
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->genreId = null;
        $this->isEditing = false;
        $this->showModal = false;
    }

    public function render()
    {
            
        $genres = Genre::paginate(8);

        return view('livewire.genres.index', [
            'genres' => $genres,
        ]);
    }
}
