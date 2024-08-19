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
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;


Route::middleware('guest')->group(function (){
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::group(['middleware' => ['role:Admin']], function () { 
        Route::get('/genres', Index::class)->name('genres');
        Route::get('/movies', Movies::class)->name('movies');
    });

    Route::group(['middleware' => ['role:Admin|User']], function () { 
        Route::get('/browse', MainBrowse::class)->name('browse'); 
        Route::get('/search-movies', MovieSearch::class)->name('search.movies');
        Route::get('/playlists', PlaylistManager::class)->name('playlists');
    });

    Route::get('/logout', [Logout::class, 'logout'])->name('logout');
});


Route::get('/email/verify', function () {
    return view('livewire.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/browse');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');