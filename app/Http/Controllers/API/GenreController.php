<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::all();
        return $genres->count() > 0 ? GenreResource::collection($genres) : response()->json(['message' => 'No genre found'], 404);
    }

    public function store(GenreRequest $request)
    { 
        $genre = Genre::create($request->validated());
        return new GenreResource($genre);

    }

    public function show(Genre $genre)
    {
        return new GenreResource($genre);
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        $genre->update($request->validated());
        return new GenreResource($genre);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json(['message' => 'Genre deleted successfully'], 200);
    }


}
