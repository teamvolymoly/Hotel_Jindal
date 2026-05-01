<div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
    <section class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
        <div>
            <h2 class="text-2xl font-semibold">Menu Item Details</h2>
            <p class="mt-2 text-muted">Control name, price, and category placement.</p>
        </div>

        <div class="mt-8 space-y-5">
            <div>
                <label for="category_id" class="mb-2 block text-sm font-medium">Category</label>
                <select id="category_id" name="category_id" class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $menuItem->category_id) == $category->id)>{{ $category->fullName() }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-medium">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $menuItem->name) }}"
                       class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>

    <section class="space-y-6">
        <div class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <h2 class="text-2xl font-semibold">Pricing & Media</h2>

            <div class="mt-6 space-y-5">
                <div>
                    <label for="price" class="mb-2 block text-sm font-medium">Price</label>
                    <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $menuItem->price) }}"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-medium">Image</label>
                    <input id="image" name="image" type="file" class="w-full rounded-2xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div data-image-preview-wrap class="{{ $menuItem->image_path ? '' : 'hidden' }} mt-4 border border-line bg-shell p-3">
                        <div class="h-32 w-full overflow-hidden bg-white">
                            <img data-image-preview src="{{ $menuItem->image_path ? asset('storage/' . $menuItem->image_path) : '' }}" alt="{{ $menuItem->name ?: 'Selected image preview' }}" class="h-full w-full object-cover">
                        </div>
                        <button type="button" data-image-clear class="mt-3 border border-line px-4 py-2 text-sm font-semibold transition hover:bg-white">
                            Delete Selected Image
                        </button>
                    </div>
                </div>

                <div>
                    <label for="sort_order" class="mb-2 block text-sm font-medium">Sort Order</label>
                    <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $menuItem->sort_order) }}"
                           class="w-full rounded-2xl border border-line bg-shell px-4 py-3.5 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    @error('sort_order')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-3 text-sm text-muted">
                    <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $menuItem->is_available)) class="h-4 w-4 rounded border-line text-brand-500 focus:ring-brand-500">
                    Show item on frontend
                </label>
            </div>
        </div>

        <div class="rounded-[2rem] border border-line bg-white p-6 shadow-panel">
            <h2 class="text-2xl font-semibold">Actions</h2>
            <div class="mt-6 flex flex-col gap-3">
                <button type="submit" class="rounded-2xl bg-brand-500 px-5 py-4 text-base font-semibold text-white transition hover:bg-brand-600">
                    {{ $submitLabel }}
                </button>
            </div>
        </div>
    </section>
</div>

<script>
    (() => {
        const input = document.getElementById('image');
        const previewWrap = document.querySelector('[data-image-preview-wrap]');
        const preview = document.querySelector('[data-image-preview]');
        const clearButton = document.querySelector('[data-image-clear]');
        const existingSrc = preview?.getAttribute('src') || '';

        input?.addEventListener('change', () => {
            const file = input.files?.[0];

            if (!file) {
                previewWrap?.classList.toggle('hidden', !existingSrc);
                if (existingSrc && preview) {
                    preview.src = existingSrc;
                }
                return;
            }

            preview.src = URL.createObjectURL(file);
            previewWrap.classList.remove('hidden');
        });

        clearButton?.addEventListener('click', () => {
            input.value = '';
            if (existingSrc && preview) {
                preview.src = existingSrc;
                previewWrap.classList.remove('hidden');
            } else {
                preview?.removeAttribute('src');
                previewWrap.classList.add('hidden');
            }
        });
    })();
</script>
