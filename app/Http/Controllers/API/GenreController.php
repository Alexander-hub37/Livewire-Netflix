<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Validation\ValidationException;

class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres, 200);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|min:3|unique:genres,name',
            ]);

            $genre = Genre::create($validatedData);

            return response()->json($genre, 201);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['error' => 'Genre not found'], 404);
        }

        return response()->json($genre, 200);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['error' => 'Genre not found'], 404);
        }

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|min:3|unique:genres,name'
            ]);

            $genre->update($validatedData);

            return response()->json($genre, 200);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json(['error' => 'Genre not found'], 404);
        }

        $genre->delete();

        return response()->json(['message' => 'Genre deleted successfully'], 200);
    }


}
