<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;
use App\Models\Qualification;
use Illuminate\Support\Facades\Auth;

class RateMovie extends Component
{
    public $movieId;
    public $rating;
    public $currentRating;

    protected $rules = [
        'rating' => 'required|integer',
    ];

    public function mount() 
    {
        $this->loadCurrentRating(); 
    }

    public function rateMovie()
    {
        $this->validate();

        $userId = Auth::id();

        $Qualification = Qualification::where('movie_id', $this->movieId)->where('user_id', $userId)->first();

        if ($Qualification) {

            $Qualification->update([
                'value' => $this->rating,
            ]);
            session()->flash('message', 'Movie rating updated successfully!');
            session()->flash('message_type', 'success');

        } else {
            
            Qualification::create([
                'movie_id' => $this->movieId,
                'user_id' => $userId,
                'value' => $this->rating,
            ]);

            session()->flash('message', 'Movie rated successfully!');
            session()->flash('message_type', 'success');
        }
    }


    public function loadCurrentRating()
    {
        $userId = Auth::id();
        $Qualification = Qualification::where('movie_id', $this->movieId)->where('user_id', $userId)->first();

        if ($Qualification) {
            $this->currentRating = $Qualification->value;
            $this->rating = $this->currentRating; 
        } else {
            $this->currentRating = null; 
            $this->rating = null; 
        }
    }

    public function render()
    {
        return view('livewire.rate-movie');
    }
}
