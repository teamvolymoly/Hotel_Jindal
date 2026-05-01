<div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
    <section class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
        <div>
            <h2 class="text-2xl font-semibold">Blog Details</h2>
            <p class="mt-2 text-muted">Manage the tag, heading, description, image, and active status used on the home page.</p>
        </div>

        <div class="mt-8 space-y-5">
            <div>
                <label for="blog_tag" class="mb-2 block text-sm font-medium">Blog Tag</label>
                <input id="blog_tag" name="blog_tag" type="text" value="{{ old('blog_tag', $blog->blog_tag) }}"
                       class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                @error('blog_tag')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="mb-2 block text-sm font-medium">Heading</label>
                <input id="title" name="title" type="text" value="{{ old('title', $blog->title) }}"
                       class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium">Description</label>
                <textarea id="description" name="description" rows="6"
                          class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">{{ old('description', $blog->excerpt) }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <h2 class="text-2xl font-semibold">Display Settings</h2>

            <div class="mt-6 space-y-5">
                <div>
                    <label for="image" class="mb-2 block text-sm font-medium">Image</label>
                    <input id="image" name="image" type="file" class="w-full rounded-2xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if ($blog->image_path)
                        <div class="mt-4 h-24 w-24 overflow-hidden rounded-2xl border border-line">
                            <img src="{{ asset('storage/' . $blog->image_path) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                        </div>
                    @endif
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium">Status</label>
                    <select id="status" name="status"
                            class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                        <option value="active" @selected(old('status', $blog->status === 'published' ? 'active' : 'inactive') === 'active')>Active</option>
                        <option value="inactive" @selected(old('status', $blog->status === 'published' ? 'active' : 'inactive') === 'inactive')>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <h2 class="text-2xl font-semibold">Actions</h2>
            <div class="mt-6 flex flex-col gap-3">
                <button type="submit" class="rounded-2xl bg-brand-500 px-5 py-4 text-base font-semibold text-white transition hover:bg-brand-600">
                    {{ $submitLabel }}
                </button>
                <a href="{{ route('admin.blogs.index') }}" class="rounded-2xl border border-line px-5 py-4 text-center text-base font-semibold transition hover:bg-shell">
                    Back to Blogs
                </a>
            </div>
        </div>
    </section>
</div>
