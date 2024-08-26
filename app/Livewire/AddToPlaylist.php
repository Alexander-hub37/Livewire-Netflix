<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\Movie;

class AddToPlaylist extends Component
{
    public $movieId;
    public $selectedPlaylist;
    public $playlists;

    public function mount()
    {
        $this->playlists = auth()->user()->playlists()->get();
    }

    public function addToPlaylist()
    {
        $playlist = Playlist::find($this->selectedPlaylist);

        if (!$playlist) {
            session()->flash('error', 'Please select a playlist.');
            return;
        }

        if ($playlist->movies->contains($this->movieId)) {
            session()->flash('error', 'This movie is already in the selected playlist.');
            return;
        }

        $playlist->movies()->attach($this->movieId);
        session()->flash('success', 'Movie added to playlist!');

    }
    
    public function render()
    {
        return view('livewire.add-to-playlist');
    }
}
