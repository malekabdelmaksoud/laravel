<?php

use App\Models\User;

beforeEach(function () {
    $this->withoutVite();
});

it('allows an admin to promote an author to admin', function () {
    $admin = User::factory()->admin()->create();
    $author = User::factory()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.role', $author))
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('success', 'Rôle mis à jour.');

    expect($author->fresh()->isAdmin())->toBeTrue();
});

it('forbids an admin to change their own role', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.role', $admin))
        ->assertForbidden();

    expect($admin->fresh()->isAdmin())->toBeTrue();
});
