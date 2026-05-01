<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Http\Resources\Admin\BlogResource;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): mixed
    {
        $blogs = Blog::with('author')->latest()->paginate(10);

        return BlogResource::collection($blogs);
    }

    public function store(BlogRequest $request): JsonResponse
    {
        $blog = Blog::create($this->payload($request));

        return response()->json([
            'message' => 'Blog created successfully.',
            'data' => new BlogResource($blog->load('author')),
        ], 201);
    }

    public function show(Blog $blog): JsonResponse
    {
        return response()->json([
            'data' => new BlogResource($blog->load('author')),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog): JsonResponse
    {
        $blog->update($this->payload($request));

        return response()->json([
            'message' => 'Blog updated successfully.',
            'data' => new BlogResource($blog->fresh()->load('author')),
        ]);
    }

    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully.',
        ]);
    }

    protected function payload(BlogRequest $request): array
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['title'], $request->route('blog')?->id);
        $data['published_at'] = $data['status'] === 'published'
            ? ($data['published_at'] ?? now())
            : null;
        $data['author_id'] = $request->user()->id;

        return $data;
    }

    protected function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug !== '' ? $baseSlug : 'blog';
        $counter = 2;

        while (
            Blog::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = ($baseSlug !== '' ? $baseSlug : 'blog') . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
