<?php

namespace App\Livewire\Genres;

use Livewire\Component;
use App\Models\Genre;
use Illuminate\Support\Facades\Cache;
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
        
        session()->flash('message', 'Genre created successfully!');
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
        $this->showModal = false;
        
        session()->flash('message', 'Genre updated successfully!');
        session()->flash('message_type', 'success');
    }

    public function delete($id)
    {
        Genre::findOrFail($id)->delete();

        session()->flash('message', 'Genre deleted successfully!');
        session()->flash('message_type', 'success');
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
