<?php

namespace App\Livewire\Genres;

use Livewire\Component;
use App\Models\Genre;


class Index extends Component
{
    public $genres;
    public $name;
    public $genreId;
    public $isEditing = false;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|min:3|unique:genres,name',
    ];

    public function mount()
    {
        $this->genres = Genre::all();
    }

    public function create()
    {
        $this->validate();
        Genre::create(['name' => $this->name]);
        $this->resetForm();
        $this->genres = Genre::all();
        $this->showModal = false;
        session()->flash('message', 'Genre created successfully! ');
        session()->flash('message_type', 'success');
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->isEditing = true;
        $this->genreId = $id;
        $genre = Genre::find($id);
        $this->name = $genre->name;
        $this->showModal = true;

    }

    public function update()
    {
        $this->validate();
        $genre = Genre::find($this->genreId);
        $genre->update(['name' => $this->name]);
        $this->resetForm();
        $this->genres = Genre::all();
        $this->showModal = false;
        session()->flash('message', 'Genre updated successfully! ');
        session()->flash('message_type', 'success');
    }

    public function delete($id)
    {
        Genre::findOrFail($id)->delete();
        $this->genres = Genre::all();
        session()->flash('message', 'Genre deleted successfully! ');
        session()->flash('message_type', 'success');
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
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
        return view('livewire.genres.index');
    }
}
