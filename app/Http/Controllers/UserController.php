<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->get();

        return view('admin.users.index', compact('users'));
    }

    public function role(User $user, Request $request): RedirectResponse
    {
        if ($request->user()->id === $user->id) {
            abort(403, 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $user->role = $user->isAdmin() ? 'author' : 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Rôle mis à jour.');
    }
}
