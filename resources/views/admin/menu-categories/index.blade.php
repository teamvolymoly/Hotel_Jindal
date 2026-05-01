@extends('admin.layouts.app')

@section('title', 'Menu Categories')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('admin.menu-categories.create') }}" class="rounded-2xl bg-brand-500 px-5 py-4 text-base font-semibold text-white transition hover:bg-brand-600">
            New Category
        </a>
    </div>

    @if ($errors->has('category'))
        <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            {{ $errors->first('category') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.menu-categories.index') }}" class="mt-6 rounded-[1.5rem] border border-line bg-white p-5 shadow-panel">
        <div class="grid gap-4 lg:grid-cols-[220px_220px_auto]">
            <div>
                <label for="type" class="mb-2 block text-sm font-medium">Type</label>
                <select id="type" name="type" class="w-full rounded-xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">All</option>
                    <option value="main" @selected(request('type') === 'main')>Main Categories</option>
                    <option value="sub" @selected(request('type') === 'sub')>Subcategories</option>
                </select>
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium">Status</label>
                <select id="status" name="status" class="w-full rounded-xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">All</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="submit" class="rounded-xl bg-brand-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-600">Apply</button>
                <a href="{{ route('admin.menu-categories.index') }}" class="rounded-xl border border-line px-5 py-3 text-sm font-semibold transition hover:bg-shell">Reset</a>
            </div>
        </div>
    </form>

    <div class="mt-8 overflow-hidden rounded-[2rem] border border-line bg-white shadow-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-shell">
                    <tr class="text-left text-sm uppercase tracking-[0.18em] text-muted">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Parent</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Sort</th>
                        <th class="px-6 py-4">Items</th>
                        <th class="px-6 py-4">Subcategories</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($categories as $category)
                        <tr class="align-middle">
                            <td class="px-6 py-5">
                                <h2 class="text-lg font-semibold">{{ $category->name }}</h2>
                                <p class="mt-1 text-sm text-muted">{{ $category->slug }}</p>
                            </td>
                            <td class="px-6 py-5 text-muted">{{ $category->parent?->name ?: 'Main Category' }}</td>
                            <td class="px-6 py-5 text-muted">{{ $category->parent_id ? 'Subcategory' : 'Category' }}</td>
                            <td class="px-6 py-5 text-muted">{{ $category->sort_order }}</td>
                            <td class="px-6 py-5 text-muted">{{ $category->items_count }}</td>
                            <td class="px-6 py-5 text-muted">{{ $category->children->count() }}</td>
                            <td class="px-6 py-5">
                                <form method="POST" action="{{ route('admin.menu-categories.update', $category) }}" class="js-category-toggle-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                                    <input type="hidden" name="parent_id" value="{{ $category->parent_id }}">
                                    <input type="hidden" name="name" value="{{ $category->name }}">
                                    <input type="hidden" name="sort_order" value="{{ $category->sort_order }}">
                                    <input type="hidden" name="is_active" value="{{ $category->is_active ? '0' : '1' }}">
                                    <button type="submit" data-toggle-button class="inline-flex min-w-[92px] items-center justify-between gap-2 border px-3 py-1.5 text-xs font-semibold transition {{ $category->is_active ? 'border-[#1f1f1f] bg-[#1f1f1f] text-white' : 'border-line bg-white text-muted hover:bg-shell' }}" aria-label="Toggle category status" data-active="{{ $category->is_active ? '1' : '0' }}">
                                        <span data-toggle-label>{{ $category->is_active ? 'Active' : 'Inactive' }}</span>
                                        <span data-toggle-dot class="h-2.5 w-2.5 {{ $category->is_active ? 'bg-white' : 'bg-[#9f968c]' }}"></span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.menu-categories.edit', $category) }}" class="rounded-xl border border-line px-4 py-2 text-sm font-semibold transition hover:bg-shell">Edit</a>
                                    <form method="POST" action="{{ route('admin.menu-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-muted">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line px-6 py-4">
            {{ $categories->links() }}
        </div>
    </div>

    <script>
        document.querySelectorAll('.js-category-toggle-form').forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const button = form.querySelector('[data-toggle-button]');
                const label = form.querySelector('[data-toggle-label]');
                const dot = form.querySelector('[data-toggle-dot]');
                const statusInput = form.querySelector('input[name="is_active"]');
                const formData = new FormData(form);

                button.disabled = true;
                button.classList.add('opacity-60');

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: formData,
                    });

                    const payload = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        throw new Error(payload.message || 'Status update failed.');
                    }

                    const isActive = Boolean(payload.data?.is_active);
                    statusInput.value = isActive ? '0' : '1';
                    button.dataset.active = isActive ? '1' : '0';
                    label.textContent = isActive ? 'Active' : 'Inactive';

                    button.classList.toggle('border-[#1f1f1f]', isActive);
                    button.classList.toggle('bg-[#1f1f1f]', isActive);
                    button.classList.toggle('text-white', isActive);
                    button.classList.toggle('border-line', !isActive);
                    button.classList.toggle('bg-white', !isActive);
                    button.classList.toggle('text-muted', !isActive);
                    button.classList.toggle('hover:bg-shell', !isActive);
                    dot.classList.toggle('bg-white', isActive);
                    dot.classList.toggle('bg-[#9f968c]', !isActive);
                } catch (error) {
                    alert(error.message || 'Status update failed.');
                } finally {
                    button.disabled = false;
                    button.classList.remove('opacity-60');
                }
            });
        });
    </script>
@endsection
