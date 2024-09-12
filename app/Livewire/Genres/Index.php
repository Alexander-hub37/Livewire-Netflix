<?php

namespace App\Livewire\Genres;

use Livewire\Component;
use App\Models\Genre;
use Livewire\WithPagination;
use App\Livewire\Forms\GenreForm;

class Index extends Component
{
    use WithPagination;
    public GenreForm $form;

    public $isEditing = false;
    public $showModal = false;


    public function create()
    {
        $this->form->create();
        $this->closeModal();
        session()->flash('success', 'Genre created successfully!');
    }


    public function edit(Genre $genre)
    {
        $this->isEditing = true;
        $this->form->fillFromModel($genre);
        $this->showModal = true;
    }

    public function update()
    {
        $this->form->update();
        $this->closeModal(); 
        session()->flash('success', 'Genre updated successfully!');
    }

    public function delete(Genre $genre)
    {
        $genre->delete();
        session()->flash('success', 'Genre deleted successfully!');
    }

    public function showCreateModal()
    {
        $this->form->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->form->resetForm();
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
