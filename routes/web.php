<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Livewire\Genres\Index;
use App\Livewire\Movies\Movies;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Browse\MovieSearch;
use App\Livewire\Browse\MainBrowse;
use App\Livewire\PlaylistManager;


Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('browse');
    });
    Route::group(['middleware' => ['can:genres']], function () {
        Route::get('/genres', Index::class)->name('genres');      
    });

    Route::group(['middleware' => ['can:movies']], function () {
        Route::get('/movies', Movies::class)->name('movies'); 
    });

    Route::group(['middleware' => ['can:browse']], function () {
        Route::get('/browse', MainBrowse::class)->name('browse');
    });

    Route::group(['middleware' => ['can:search.movies']], function () {
        Route::get('/search-movies', MovieSearch::class)->name('search.movies');
    });

    Route::group(['middleware' => ['can:playlists']], function () {
        Route::get('/playlists', PlaylistManager::class)->name('playlists');
    });


    Route::get('/logout', [Logout::class, 'logout'])->name('logout');
});


Route::get('/email/verify', function () {
    return view('livewire.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/genres');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');