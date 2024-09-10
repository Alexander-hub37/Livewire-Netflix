<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Movie;
use Illuminate\Validation\ValidationException;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = auth()->user()->playlists()->with('movies')->get();
        return response()->json($playlists, 200);
    }


    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|min:3',
            ]);

            $playlist = auth()->user()->playlists()->create([
                'name' => $request->name,
            ]);

            return response()->json([
                'message' => 'Playlist created successfully!',
                'playlist' => $playlist,
            ], 201);
        } 
        catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

  
    public function addToPlaylist(Request $request)
    {
        try{
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $playlist = auth()->user()->playlists()->findOrFail($request->playlist_id);

        if ($playlist->movies->contains($request->movie_id)) {
            return response()->json([
                'message' => 'Movie already in playlist.',
            ], 409);
        }

        $playlist->movies()->attach($request->movie_id);

        return response()->json([
            'message' => 'Movie added to playlist successfully!',
        ], 200);
        }
        catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }

    }

    
    public function removeFromPlaylist(Request $request)
    {
        try{
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $playlist = auth()->user()->playlists()->findOrFail($request->playlist_id);

        $playlist->movies()->detach($request->movie_id);

        return response()->json([
            'message' => 'Movie removed from playlist successfully!',
        ], 200);
        } catch(ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    
    public function destroy($id)
    {
        $playlist = auth()->user()->playlists()->find($id);

        if (!$playlist) {
            return response()->json(['message' => 'Playlist not found'], 404);
        }

        $playlist->delete();

        return response()->json([
            'message' => 'Playlist deleted successfully!',
        ], 200);
    }
}
