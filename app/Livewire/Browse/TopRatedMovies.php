<?php

namespace App\Livewire\Browse;

use Livewire\Component;
use App\Models\Movie;

class TopRatedMovies extends Component
{
    public $topRatedMovies;

    public function mount()
    {
        $this->topRatedMovies = $this->getTopRatedMovies();
    }

    public function getTopRatedMovies()
    {
        return Movie::withAvg('qualifications', 'value')->orderBy('qualifications_avg_value', 'desc')->limit(5)->get();    }

    public function render()
    {
        return view('livewire.browse.top-rated-movies');
    }

}
