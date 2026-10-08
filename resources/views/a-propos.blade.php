<x-layout>
    <x-slot:title>À propos - Mini-CMS</x-slot:title>

    <h1 class="text-3xl font-bold">À propos de Mini-CMS</h1>
    <p class="mt-4 text-gray-700">Mini-CMS est le projet fil rouge de l'Atelier Framework Côté Serveur (Laravel 13).</p>
    <p class="mt-2 text-gray-700">Auteur : {{ $auteur }}</p>
    <p class="mt-2 text-gray-700">Groupe : {{ $groupe }}</p>
    <p class="mt-6">
        <a href="/heure" class="text-red-600 underline">Heure du serveur</a>
    </p>
</x-layout>
@extends('layouts.app')

@section('title', 'À propos - Mini-CMS')

@section('content')
    <h1>À propos de Mini-CMS</h1>
@endsection