<?php

use App\Models\Post;
use Illuminate\Support\Facades\Config;

beforeEach(function () {
    $this->withoutVite();
});

function feedbackPostData(array $overrides = []): array
{
    return array_merge([
        'title' => 'Article avec message',
        'slug' => 'article-avec-message',
        'body' => 'Contenu assez long pour passer la validation.',
        'is_published' => '1',
    ], $overrides);
}

it('shows a success message after creating a post', function () {
    $this->followingRedirects()
        ->post(route('posts.store'), feedbackPostData())
        ->assertOk()
        ->assertSee('Article créé.');
});

it('shows a success message after deleting a post', function () {
    $post = Post::factory()->create();

    $this->followingRedirects()
        ->delete(route('posts.destroy', $post))
        ->assertOk()
        ->assertSee('Article supprimé.');
});

it('shows the custom page for an unknown post', function () {
    $this->get('/posts/999')
        ->assertNotFound()
        ->assertSee('Article introuvable');
});

it('keeps the standard 404 page for an unknown category', function () {
    $this->get('/posts/categorie/inconnue')
        ->assertNotFound()
        ->assertDontSee('Article introuvable');
});

it('shows the read-only banner on the homepage when site is read-only', function () {
    Config::set('site.read_only', true);

    $this->get('/')
        ->assertOk()
        ->assertSee('Site en lecture seule');
});

it('shows a published post but not a draft on the unknown post page', function () {
    $published = Post::factory()->published()->create(['title' => 'Article Visible']);
    $draft = Post::factory()->create(['title' => 'Brouillon Secret']);

    $this->get('/posts/999')
        ->assertNotFound()
        ->assertSee('Article Visible')
        ->assertDontSee('Brouillon Secret');
});
