<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Genre;

class GenreForm extends Form
{
    #[Validate('required|string|min:3|unique:genres,name')]
    public $name = '';

    public $genreId = null;

    public $genre = null;

    public function create()
    {
        $this->validate();
        Genre::create($this->all());
        $this->resetForm();
    }

    public function update()
    {
        $this->validate(); 

        if ($this->genre) {
            $this->genre->update($this->all()); 
            $this->resetForm();
        }
    }


    public function fillFromModel(Genre $genre)
    {
        $this->fill([
            'name' => $genre->name,
            'genreId' => $genre->id,
        ]);

        $this->genre = $genre;
    }

    public function resetForm()
    {
        $this->fill([
            'name' => '',
            'genreId' => null,
        ]);

        $this->genre = null;
    }
}
