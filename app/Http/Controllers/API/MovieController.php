<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;


class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genres')->get();
        return $movies->count() > 0 ? MovieResource::collection($movies) : response()->json(['message' => 'No movie found'], 404);
    }

    public function store(MovieRequest $request)
    {
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        $movie = Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if ($request->has('genres')) {
            $movie->genres()->sync($request->genres);
        }

        return response()->json([
            'message' => 'Movie created successfully!',
            'movie' => new MovieResource($movie)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        if ($request->hasFile('image')) {
            if ($movie->image) {
                Storage::disk('public')->delete($movie->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $movie->image;
        }

        $movie->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if ($request->has('genres')) {
            $movie->genres()->sync($request->genres);
        }

        return response()->json([
            'message' => 'Movie updated successfully!',
            'movie' => new MovieResource($movie)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->image && Storage::disk('public')->delete($movie->image);
        $movie->delete();
        return response()->json(['message' => 'Movie deleted successfully!']);
    }
}
