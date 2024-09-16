<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieForm extends Form
{
    #[Validate('required|string|min:3')]
    public $title = '';

    #[Validate('nullable|required|min:3')]
    public $description = '';

    #[Validate('nullable|image|mimes:jpeg,png,jpg|max:2048')]
    public $image = null;

    #[Validate('required|array')]
    public $selectedGenres = [];

    public $movieId = null;

    public $movie = null;
    
    public function create()
    {
        $this->validate();

        $imagePath = $this->image?->store('images', 'public');

        $movie = Movie::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $movie->genres()->sync($this->selectedGenres);

        $this->resetForm(); 
    }

    
    public function update()
    {
        $this->validate();

        if ($this->movie) {  
            if ($this->image) {
                if ($this->movie->image) {
                    Storage::disk('public')->delete($this->movie->image);
                }
                $imagePath = $this->image->store('images', 'public');
            } else {
                $imagePath = $this->movie->image;
            }

            $this->movie->update([
                'title' => $this->title,
                'description' => $this->description,
                'image' => $imagePath,
            ]);

            $this->movie->genres()->sync($this->selectedGenres);
        }

        $this->resetForm(); 
    }

    
    public function fillFromModel(Movie $movie)
    {
        $this->fill([
            'title' => $movie->title,
            'description' => $movie->description,
            'selectedGenres' => $movie->genres->pluck('id')->toArray(),
            'movieId' => $movie->id,
        ]);

        $this->movie = $movie;
    }

    
    public function resetForm()
    {
        $this->fill([
            'title' => '',
            'description' => '',
            'image' => null,
            'selectedGenres' => [],
            'movieId' => null,
        ]);

        $this->movie = null;
    }
}
