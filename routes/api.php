<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\RatemovieController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['middleware' => ['role:Admin']], function () { 
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('movies', MovieController::class);
    });
    Route::group(['middleware' => ['role:Admin|User']], function () { 
        Route::get('playlists', [PlaylistController::class, 'index']);
        Route::post('playlists', [PlaylistController::class, 'store']);
        Route::post('playlists/add-movie', [PlaylistController::class, 'addToPlaylist']);
        Route::post('playlists/remove-movie', [PlaylistController::class, 'removeFromPlaylist']);
        Route::delete('playlists/{id}', [PlaylistController::class, 'destroy']);
        Route::post('rate-movie', [RatemovieController::class, 'rateMovie'] );
        Route::get('movies', [MovieController::class, 'index'] );

    });
    Route::post('logout', [AuthController::class, 'logout']);  
});