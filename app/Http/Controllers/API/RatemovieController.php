<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class RatemovieController extends Controller
{
    public function rateMovie(Request $request)
    {
        try {
            
            $validatedData = $request->validate([
                'movie_id' => 'required|exists:movies,id',
                'rating' => 'required|numeric|min:1|max:5', 
            ]);

            $userId = Auth::id();
            $movieId = $validatedData['movie_id'];
            $rating = $validatedData['rating'];

            $qualification = Qualification::where(['movie_id' => $movieId, 'user_id' => $userId])->first();

            if ($qualification) {
                
                $qualification->update(['value' => $rating]);

                return response()->json([
                    'message' => 'Movie rating updated successfully!',
                ], 200);
            } else {
                
                Qualification::create([
                    'movie_id' => $movieId,
                    'user_id' => $userId,
                    'value' => $rating,
                ]);

                return response()->json([
                    'message' => 'Movie rated successfully!',
                ], 201);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } 
    }
}
