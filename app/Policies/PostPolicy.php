<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function view(?User $user, Post $post): bool
    {
        if ($post->is_published) {
            return true;
        }

        return $user !== null && $this->update($user, $post);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}
