<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/a-propos', [PageController::class, 'about'])->name('about');

Route::get('/heure', function () {
    return view('heure', [
        'heure' => now()->format('H:i'),
        'date' => now()->format('d/m/Y'),
    ]);
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/archive/{year}', [PostController::class, 'archive'])
    ->whereNumber('year')
    ->name('posts.archive');

Route::get('/posts/{slug}', [PostController::class, 'show'])
    ->where('slug', '[a-z0-9-]+')
    ->name('posts.show');