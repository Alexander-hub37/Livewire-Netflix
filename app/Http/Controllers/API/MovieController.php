<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;
use Illuminate\Validation\ValidationException;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with('genres')->get();
        return response()->json($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'genres' => 'array', 
            'genres.*' => 'exists:genres,id', 
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        $movie = Movie::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
        ]);

        if (isset($validatedData['genres'])) {
            $movie->genres()->sync($validatedData['genres']);
        }

        return response()->json([
            'message' => 'Movie created successfully!',
            'movie' => $movie->load('genres')
        ], 201);
        }
        catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::with('genres')->find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        if ($request->hasFile('image')) {
            if ($movie->image) {
                Storage::disk('public')->delete($movie->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $movie->image;
        }

        $movie->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
        ]);

        if (isset($validatedData['genres'])) {
            $movie->genres()->sync($validatedData['genres']);
        }

        return response()->json([
            'message' => 'Movie updated successfully!',
            'movie' => $movie->load('genres')
        ]);
        } 
        catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        if ($movie->image) {
            Storage::disk('public')->delete($movie->image);
        }

        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully!']);
    }
}
