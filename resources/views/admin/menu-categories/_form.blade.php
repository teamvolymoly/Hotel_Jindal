<div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
    <section class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
        <div>
            <h2 class="text-2xl font-semibold">Category Details</h2>
            <p class="mt-2 text-muted">Create a main category or place this category under an existing parent.</p>
        </div>

        <div class="mt-8 space-y-5">
            <div>
                <label for="parent_id" class="mb-2 block text-sm font-medium">Parent Category</label>
                <select id="parent_id" name="parent_id"
                        class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">Main Category</option>
                    @foreach ($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->id }}" @selected(old('parent_id', $menuCategory->parent_id) == $parentCategory->id)>
                            {{ $parentCategory->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-medium">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $menuCategory->name) }}"
                       class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <h2 class="text-2xl font-semibold">Settings</h2>

            <div class="mt-6 space-y-5">
                <div class="rounded-2xl border border-dashed border-line bg-shell px-4 py-3 text-sm text-muted">
                    Leave parent category as Main Category to create a top-level category. Select a category first to save this as a subcategory.
                </div>

                <div>
                    <label for="sort_order" class="mb-2 block text-sm font-medium">Sort Order</label>
                    <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $menuCategory->sort_order) }}"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    @error('sort_order')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-3 text-sm text-muted">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $menuCategory->is_active)) class="h-4 w-4 rounded border-line text-brand-500 focus:ring-brand-500">
                    Active on frontend
                </label>
            </div>
        </div>

        <div class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <h2 class="text-2xl font-semibold">Actions</h2>
            <div class="mt-6 flex flex-col gap-3">
                <button type="submit" class="rounded-2xl bg-brand-500 px-5 py-4 text-base font-semibold text-white transition hover:bg-brand-600">
                    {{ $submitLabel }}
                </button>
                <a href="{{ route('admin.menu-categories.index') }}" class="rounded-2xl border border-line px-5 py-4 text-center text-base font-semibold transition hover:bg-shell">
                    Back to Categories
                </a>
            </div>
        </div>
    </section>
</div>
