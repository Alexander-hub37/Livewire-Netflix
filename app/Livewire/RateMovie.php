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

        $qualification = Qualification::where([ ['movie_id', $this->movieId], ['user_id', $userId] ])->first();

        if ($qualification) {

            $qualification->update([
                'value' => $this->rating,
            ]);
            session()->flash('success', 'Movie rating updated successfully!');

        } else {
            
            Qualification::create([
                'movie_id' => $this->movieId,
                'user_id' => $userId,
                'value' => $this->rating,
            ]);

            session()->flash('success', 'Movie rated successfully!');
        }
    }


    public function loadCurrentRating()
    {
        $userId = Auth::id();
        $qualification = Qualification::where([ ['movie_id', $this->movieId], ['user_id', $userId] ])->first();
        
        $this->rating  = $qualification ? $qualification->value : null;
       
    }

    public function render()
    {
        return view('livewire.rate-movie');
    }
}
