@extends('admin.layouts.app')

@section('title', 'Menu Items')

@section('content')
    <div class="flex justify-end">
        <a href="{{ route('admin.menu-items.create') }}" class="rounded-2xl bg-brand-500 px-5 py-4 text-base font-semibold text-white transition hover:bg-brand-600">
            New Menu Item
        </a>
    </div>

    <form method="GET" action="{{ route('admin.menu-items.index') }}" class="mt-6 rounded-[1.5rem] border border-line bg-white p-5 shadow-panel">
        <div class="grid gap-4 lg:grid-cols-[260px_220px_auto]">
            <div>
                <label for="category_id" class="mb-2 block text-sm font-medium">Category</label>
                <select id="category_id" name="category_id" class="w-full rounded-xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">All Categories</option>
                    @foreach ($filterCategories as $category)
                        <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>{{ $category->fullName() }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="mb-2 block text-sm font-medium">Status</label>
                <select id="status" name="status" class="w-full rounded-xl border border-line bg-shell px-4 py-3 outline-none transition focus:border-brand-500 focus:ring-2 focus:ring-brand-100">
                    <option value="">All</option>
                    <option value="available" @selected(request('status') === 'available')>Available</option>
                    <option value="hidden" @selected(request('status') === 'hidden')>Hidden</option>
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="submit" class="rounded-xl bg-brand-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-600">Apply</button>
                <a href="{{ route('admin.menu-items.index') }}" class="rounded-xl border border-line px-5 py-3 text-sm font-semibold transition hover:bg-shell">Reset</a>
            </div>
        </div>
    </form>

    <div class="mt-8 overflow-hidden rounded-[2rem] border border-line bg-white shadow-panel">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-shell">
                    <tr class="text-left text-sm uppercase tracking-[0.18em] text-muted">
                        <th class="px-6 py-4">Item</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($items as $item)
                        <tr class="align-middle">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-shell">
                                        @if ($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-xs text-muted">No image</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-semibold">{{ $item->name }}</h2>
                                        <p class="mt-1 text-sm text-muted">Sort order: {{ $item->sort_order }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-muted">{{ $item->category?->fullName() }}</td>
                            <td class="px-6 py-5 text-muted">Rs. {{ number_format((float) $item->price, 2) }}</td>
                            <td class="px-6 py-5">
                                <form method="POST" action="{{ route('admin.menu-items.update', $item) }}" class="js-item-toggle-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="redirect_to" value="{{ url()->full() }}">
                                    <input type="hidden" name="category_id" value="{{ $item->category_id }}">
                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                    <input type="hidden" name="sort_order" value="{{ $item->sort_order }}">
                                    <input type="hidden" name="is_available" value="{{ $item->is_available ? '0' : '1' }}">
                                    <button type="submit" data-toggle-button class="inline-flex min-w-[104px] items-center justify-between gap-2 border px-3 py-1.5 text-xs font-semibold transition {{ $item->is_available ? 'border-[#1f1f1f] bg-[#1f1f1f] text-white' : 'border-line bg-white text-muted hover:bg-shell' }}" aria-label="Toggle item availability" data-active="{{ $item->is_available ? '1' : '0' }}">
                                        <span data-toggle-label>{{ $item->is_available ? 'Available' : 'Hidden' }}</span>
                                        <span data-toggle-dot class="h-2.5 w-2.5 {{ $item->is_available ? 'bg-white' : 'bg-[#9f968c]' }}"></span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.menu-items.edit', $item) }}" class="rounded-xl border border-line px-4 py-2 text-sm font-semibold transition hover:bg-shell">Edit</a>
                                    <form method="POST" action="{{ route('admin.menu-items.destroy', $item) }}" onsubmit="return confirm('Delete this menu item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-muted">No menu items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line px-6 py-4">
            {{ $items->links() }}
        </div>
    </div>

    <script>
        document.querySelectorAll('.js-item-toggle-form').forEach((form) => {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const button = form.querySelector('[data-toggle-button]');
                const label = form.querySelector('[data-toggle-label]');
                const dot = form.querySelector('[data-toggle-dot]');
                const statusInput = form.querySelector('input[name="is_available"]');
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
                        throw new Error(payload.message || 'Availability update failed.');
                    }

                    const isAvailable = Boolean(payload.data?.is_available);
                    statusInput.value = isAvailable ? '0' : '1';
                    button.dataset.active = isAvailable ? '1' : '0';
                    label.textContent = isAvailable ? 'Available' : 'Hidden';

                    button.classList.toggle('border-[#1f1f1f]', isAvailable);
                    button.classList.toggle('bg-[#1f1f1f]', isAvailable);
                    button.classList.toggle('text-white', isAvailable);
                    button.classList.toggle('border-line', !isAvailable);
                    button.classList.toggle('bg-white', !isAvailable);
                    button.classList.toggle('text-muted', !isAvailable);
                    button.classList.toggle('hover:bg-shell', !isAvailable);
                    dot.classList.toggle('bg-white', isAvailable);
                    dot.classList.toggle('bg-[#9f968c]', !isAvailable);
                } catch (error) {
                    alert(error.message || 'Availability update failed.');
                } finally {
                    button.disabled = false;
                    button.classList.remove('opacity-60');
                }
            });
        });
    </script>
@endsection
