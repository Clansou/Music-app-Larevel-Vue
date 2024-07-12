<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/',[TrackController::class, 'index'])->name('tracks.index');
Route::get('/test', [HomeController::class, 'HelloWorld'])->name('test');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    //Tracks
    Route::name('tracks.')->prefix('tracks')->controller(TrackController::class)->group(function (){
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{track}','show')->name('show');
        Route::get('/{track}/edit','edit')->name('edit');
        Route::put('/{track}','update')->name('update');
        Route::delete('/{track}','destroy')->name('destroy');
    });
});





// Route::resources('tracks',TrackController::class)->except(['show']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->name('playlist.')->prefix('playlist')->controller(PlaylistController::class)->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
    Route::get('/{playlist}','show')->name('show');
    Route::get('/{playlist}/edit','edit')->name('edit');
    Route::put('/{playlist}','update')->name('update');
    Route::delete('/{playlist}','destroy')->name('destroy');
});


