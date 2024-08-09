<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Genres\Index;


Route::get('/', function () {
    return redirect()->route('genres');
});
Route::get('/genres', Index::class)->name('genres');




