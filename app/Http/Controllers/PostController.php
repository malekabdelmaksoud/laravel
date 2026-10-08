<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    private function posts(): array
    {
        return [
            'decouvrir-laravel-13' => [
                'title' => 'Découvrir Laravel 13',
                'year' => 2026,
                'body' => 'Laravel 13 simplifie la structure du projet : la configuration des middlewares et des exceptions se fait dans bootstrap/app.php.',
            ],
            'routes-et-controleurs' => [
                'title' => 'Routes et contrôleurs',
                'year' => 2026,
                'body' => 'Une route associe une URL à une méthode de contrôleur. Le contrôleur prépare les données, la vue les affiche.',
            ],
            'premiers-pas-avec-blade' => [
                'title' => 'Premiers pas avec Blade',
                'year' => 2025,
                'body' => 'Blade est le moteur de vues de Laravel. Les doubles accolades échappent toujours le contenu affiché.',
            ],
        ];
    }

    public function index()
    {
        return view('posts.index', [
            'heading' => 'Tous les articles',
            'posts' => $this->posts(),
        ]);
    }
}