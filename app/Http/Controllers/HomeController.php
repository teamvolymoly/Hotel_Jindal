<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $homeBlogs = Blog::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->latest()
            ->take(3)
            ->get();

        return view('pages.home', compact('homeBlogs'));
    }

    public function showBlog(Blog $blog): View
    {
        abort_unless($blog->status === 'published', 404);

        $relatedBlogs = Blog::query()
            ->where('status', 'published')
            ->whereKeyNot($blog->getKey())
            ->latest('published_at')
            ->latest()
            ->take(3)
            ->get();

        return view('pages.blog-detail', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
        ]);
    }
}
