<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerIndexController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/players', [PlayerIndexController::class, 'index'])->name('players.index');
Route::get('/players/{id}', [PlayerController::class, 'show'])->name('players.show');
Route::get('/teams', [TeamIndexController::class, 'show'])->name('teams.index');
Route::get('/teams/{id}', [TeamController::class, 'show'])->name('teams.show');

Route::resource('/teams', TeamController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
