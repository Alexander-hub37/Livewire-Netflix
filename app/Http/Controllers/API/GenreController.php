<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres, 200);
    }

    public function store(GenreRequest $request)
    { 
        $genre = Genre::create($request->validated());
        return response()->json($genre, 201);
    }

    public function show(Genre $genre)
    {
        return response()->json($genre, 200);
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        $genre->update($request->validated());
        return response()->json($genre, 200);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json(['message' => 'Genre deleted successfully'], 200);
    }


}
