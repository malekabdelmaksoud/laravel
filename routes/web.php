<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bonjour', function () {
    return 'Bonjour MDW3 ! Voici ma première route Laravel 13.';
});

Route::get('/bonjour-court', fn () => 'Même résultat, écrit avec une fonction fléchée.');
Route::get('/version', function () {
    return app()->version() . ' - PHP ' . PHP_VERSION;
});
Route::get('/heure', function () {
    return view('heure');
});
Route::get('/bienvenue', function () {
    return view('bienvenue', [
        'etudiant' => 'melek abdelmaksoud',
        'groupe' => 'MDW32',
        'cours' => 'Atelier Framework Côté Serveur',
    ]);
    Route::get('/a-propos', function () {
    return view('a-propos', [
        'auteur' => 'MELEKABDELMAKSOUD',
        'groupe' => 'MDW32',
    ]);
});
});