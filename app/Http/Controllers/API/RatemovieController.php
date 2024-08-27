<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Validation\ValidationException;

class RatemovieController extends Controller
{
    public function rateMovie(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'movie_id' => 'required|exists:movies,id',
                'rating' => 'required|numeric|min:1|max:5',
            ]);

            $movieId = $validatedData['movie_id'];
            $rating = $validatedData['rating'];

            $qualification = auth()->user()->qualifications()->where('movie_id', $movieId)->first();

            if ($qualification) {
                $qualification->update(['value' => $rating]);
                $message = 'Movie rating updated successfully!';
            } else {
                auth()->user()->qualifications()->create([
                    'movie_id' => $movieId,
                    'value' => $rating,
                ]);
                $message = 'Movie rated successfully!';
            }

            return response()->json(['message' => $message], $qualification ? 200 : 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }
}

