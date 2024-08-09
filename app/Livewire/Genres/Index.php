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
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->genreId = $id;
        $genre = Genre::findOrFail($id);
        $this->name = $genre->name;
    }

    public function update()
    {
        $this->validate();
        $genre = Genre::findOrFail($this->genreId);
        $genre->update(['name' => $this->name]);
        $this->resetForm();
        $this->genres = Genre::all();
    }

    public function delete($id)
    {
        Genre::findOrFail($id)->delete();
        $this->genres = Genre::all();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->genreId = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.genres.index');
    }
}
