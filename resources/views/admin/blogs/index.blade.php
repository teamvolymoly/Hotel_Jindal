@extends('admin.layouts.app')

@section('title', 'Manage Blogs')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('admin.blogs.create') }}" class="rounded-2xl bg-brand-500 px-5 py-4 text-base font-semibold text-white transition hover:bg-brand-600">
            New Blog
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-[2rem] border border-line bg-white shadow-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-shell">
                    <tr class="text-left text-sm uppercase tracking-[0.18em] text-muted">
                        <th class="px-6 py-4">Blog</th>
                        <th class="px-6 py-4">Tag</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($blogs as $blog)
                        <tr class="align-middle">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-shell">
                                        @if ($blog->image_path)
                                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-xs text-muted">No image</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-semibold">{{ $blog->title }}</h2>
                                        <p class="mt-2 max-w-xl text-sm text-muted">{{ \Illuminate\Support\Str::limit($blog->excerpt, 110) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-muted">{{ $blog->blog_tag }}</td>
                            <td class="px-6 py-5">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $blog->status === 'published' ? 'bg-brand-100 text-brand-700' : 'border border-line bg-shell text-muted' }}">
                                    {{ $blog->status === 'published' ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="rounded-xl border border-line px-4 py-2 text-sm font-semibold transition hover:bg-shell">Edit</a>
                                    <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" onsubmit="return confirm('Delete this blog?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-muted">No blogs found. Create your first one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line px-6 py-4">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
