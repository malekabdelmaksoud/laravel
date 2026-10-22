@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Create New Post</h1>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block font-medium">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label for="slug" class="block font-medium">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label for="body" class="block font-medium">Body</label>
            <textarea name="body" id="body" rows="8" class="w-full border rounded px-3 py-2" required>{{ old('body') }}</textarea>
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="is_published" id="is_published" value="1" class="mr-2" {{ old('is_published') ? 'checked' : '' }}>
            <label for="is_published" class="font-medium">Publish immediately</label>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Post</button>
        </div>
    </form>
</div>
@endsection