<?php

namespace App\Livewire\Browse;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Genre;

class MainBrowse extends Component
{
    public $latestMovie;
    public $moviesByGenre;
    public $selectedMovie = null;

    public function mount()
    {
        $this->latestMovie = Movie::latest()->first();

        $this->moviesByGenre = Genre::with(['movies' => function ($query) {
            $query->orderBy('movies.created_at', 'desc')->take(4);
        }])->get()->pluck('movies', 'name');
       
    }

    public function selectMovie(Movie $movie)
    {
        $this->selectedMovie = $movie;
    }

    public function closeModal()
    {
        $this->selectedMovie = null;
    }

    public function render()
    {
        return view('livewire.browse.main-browse')->layout('components.layouts.browse');
    }
}
