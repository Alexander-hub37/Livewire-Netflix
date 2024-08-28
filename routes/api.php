<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\RatemovieController;
use App\Http\Controllers\API\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['middleware' => ['role:Admin']], function () { 
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('movies', MovieController::class);
        Route::get('users', [UserController::class, 'index'])->name('getUsers');
       
    });
    Route::group(['middleware' => ['role:Admin|User']], function () { 
        Route::get('playlists', [PlaylistController::class, 'index'])->name('getPlaylists');
        Route::post('playlists', [PlaylistController::class, 'store'])->name('storePlaylist');
        Route::post('playlists/add-movie', [PlaylistController::class, 'addToPlaylist'])->name('addMovieToPlaylist');
        Route::post('playlists/remove-movie', [PlaylistController::class, 'removeFromPlaylist'])->name('removeMovieFromPlaylist');
        Route::delete('playlists/{id}', [PlaylistController::class, 'destroy'])->name('deletePlaylist');
        Route::post('rate-movie', [RatemovieController::class, 'rateMovie'])->name('rateMovie');
        Route::get('movies', [MovieController::class, 'index'])->name('getMovies');

    });
    Route::post('logout', [AuthController::class, 'logout']);  
});