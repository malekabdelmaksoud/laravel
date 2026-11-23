<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $tags = Tag::withCount(['posts' => fn (Builder $query) => $query->published()])
            ->orderBy('name')
            ->get();

        return TagResource::collection($tags);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): TagResource
    {
        return new TagResource(
            $tag->loadCount(['posts' => fn (Builder $query) => $query->published()])
        );
    }
}
