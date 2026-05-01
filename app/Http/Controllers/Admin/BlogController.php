<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('admin.blogs.create', [
            'blog' => new Blog([
                'status' => 'draft',
            ]),
        ]);
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        Blog::create($this->payload($request));

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog created successfully.');
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $blog->update($this->payload($request, $blog));

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->image_path) {
            Storage::disk('public')->delete($blog->image_path);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog deleted successfully.');
    }

    protected function payload(BlogRequest $request, ?Blog $blog = null): array
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['title'], $blog?->id);
        $data['excerpt'] = $data['description'];
        $data['content'] = $data['description'];
        $data['status'] = $data['status'] === 'active' ? 'published' : 'draft';
        $data['published_at'] = $data['status'] === 'published'
            ? ($blog?->published_at ?? now())
            : null;
        $data['author_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            if ($blog?->image_path) {
                Storage::disk('public')->delete($blog->image_path);
            }

            $data['image_path'] = $request->file('image')->store('blogs', 'public');
        }

        unset($data['description'], $data['image']);

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
