<?php

namespace App\Livewire\Browse;

use App\Models\Movie;
use Livewire\Component;

class MovieSearch extends Component
{
    public $search = '';
    
    public function render()
    {

        return view('livewire.browse.movie-search', [
            'movies' => Movie::where('title', 'like', '%'.$this->search.'%')->get(),
        ])->layout('components.layouts.browse');
    }
}
