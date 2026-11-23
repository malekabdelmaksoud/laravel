<?php

use App\Http\Middleware\EnsureSiteIsWritable;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'writable' => EnsureSiteIsWritable::class,
            'admin' => EnsureUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return null;
            }

            $previous = $e->getPrevious();

            if ($previous instanceof ModelNotFoundException && $previous->getModel() === Post::class) {
                $recentPosts = Post::published()
                    ->with('user', 'category', 'tags')
                    ->latest('published_at')
                    ->take(3)
                    ->get();

                return response()->view('errors.article-introuvable', [
                    'recentPosts' => $recentPosts,
                ], 404);
            }

            if ($previous instanceof ModelNotFoundException && $previous->getModel() === Category::class) {
                $categories = Category::orderBy('name')->get();

                return response()->view('errors.categorie-introuvable', [
                    'categories' => $categories,
                ], 404);
            }

            return null;
        });
    })->create();
