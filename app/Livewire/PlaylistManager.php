<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;


class PlaylistManager extends Component
{
    public $playlists;
    public $newPlaylistName;
    public $showModal = false;

    protected $rules = [
        'newPlaylistName' => 'required|string|min:3',
    ];

    public function mount()
    {
        $this->playlists = auth()->user()->playlists()->with('movies')->get();
    }

    public function createPlaylist()
    {
        $this->validate();

        $playlist = auth()->user()->playlists()->create([
            'name' => $this->newPlaylistName,
        ]);


        $this->playlists = auth()->user()->playlists()->with('movies')->get();
        $this->newPlaylistName = '';
        $this->showModal = false;
        session()->flash('message', 'Playlist created successfully!');
        session()->flash('message_type', 'success');
    }


    public function removeFromPlaylist($movieId, $playlistId)
    {
        $playlist = Playlist::find($playlistId);

        if (!$playlist) {
            session()->flash('message', 'Playlist not found.');
            session()->flash('message_type', 'error');
            return;
        }

        $playlist->movies()->detach($movieId);
        session()->flash('message', 'Movie removed from playlist.');
        session()->flash('message_type', 'success');


        $this->playlists = auth()->user()->playlists()->with('movies')->get();
    }

    public function deletePlaylist($playlistId)
    {
        $playlist = Playlist::find($playlistId);

        if (!$playlist) {
            session()->flash('message', 'Playlist not found.');
            session()->flash('message_type', 'error');
            return;
        }

        $playlist->delete();
        session()->flash('message', 'Playlist deleted successfully! ');
        session()->flash('message_type', 'success');

        $this->playlists = auth()->user()->playlists()->with('movies')->get();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.playlist-manager')->layout('components.layouts.browse');
    }
}
