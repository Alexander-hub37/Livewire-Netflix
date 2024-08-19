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
            session()->flash('message', 'Please select a playlist.');
            session()->flash('message_type', 'error');
            return;
        }

        if ($playlist->movies->contains($this->movieId)) {
            session()->flash('message', 'This movie is already in the selected playlist.');
            session()->flash('message_type', 'error');
            return;
        }

        $playlist->movies()->attach($this->movieId);
        session()->flash('message', 'Movie added to playlist!');
        session()->flash('message_type', 'success');

    }
    
    public function render()
    {
        return view('livewire.add-to-playlist');
    }
}
