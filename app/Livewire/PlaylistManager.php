<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Playlist;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;


class PlaylistManager extends Component
{

    public $newPlaylistName;
    public $showModal = false;

    protected $rules = [
        'newPlaylistName' => 'required|string|min:3',
    ];

    public function createPlaylist()
    {
        $this->validate();

        $playlist = auth()->user()->playlists()->create([
            'name' => $this->newPlaylistName,
        ]);

        $this->newPlaylistName = '';
        $this->showModal = false;
        session()->flash('success', 'Playlist created successfully!');
    }


    public function removeFromPlaylist(Movie $movie, Playlist $playlist)
    {

        if (!$playlist->exists) {
            session()->flash('error', 'Playlist not found.');
            return;
        }

        $playlist->movies()->detach($movie);
        session()->flash('success', 'Movie removed from playlist.');

    }

    public function deletePlaylist(Playlist $playlist)
    {

        if (!$playlist->exists) {
            session()->flash('error', 'Playlist not found.');
            return;
        }

        $playlist->delete();
        session()->flash('success', 'Playlist deleted successfully! ');

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
        $playlists = auth()->user()->playlists()->with('movies')->get();

        return view('livewire.playlist-manager', [
            'playlists' => $playlists,
            ])
            ->layout('components.layouts.browse');
    }
}
