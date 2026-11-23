<?php

use App\Models\Post;
use App\Models\Tag;

it('lists tags with published post count and expected structure', function () {
    $tag = Tag::factory()->create();
    $post1 = Post::factory()->published()->create();
    $post2 = Post::factory()->published()->create();
    $draft = Post::factory()->create();

    $tag->posts()->attach([$post1->id, $post2->id, $draft->id]);

    $this->getJson('/api/tags')
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'slug', 'posts_count'],
            ],
        ])
        ->assertJsonPath('data.0.posts_count', 2);
});

it('filters posts by tag slug', function () {
    $tag = Tag::factory()->create();
    $taggedPost = Post::factory()->published()->create(['title' => 'Article avec tag']);
    $otherPost = Post::factory()->published()->create(['title' => 'Article sans tag']);

    $taggedPost->tags()->attach($tag);

    $this->getJson('/api/posts?tag='.$tag->slug)
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $taggedPost->id)
        ->assertJsonPath('data.0.title', 'Article avec tag');
});

it('returns 404 for an unknown tag', function () {
    $this->getJson('/api/tags/999999')
        ->assertNotFound()
        ->assertJsonStructure(['message']);
});
