<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuItemRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(Request $request): View
    {
        $items = MenuItem::with('category.parent')
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim((string) $request->string('q'));
                $query->where(function ($innerQuery) use ($term) {
                    $innerQuery->where('name', 'like', '%' . $term . '%')
                        ->orWhere('slug', 'like', '%' . $term . '%')
                        ->orWhereHas('category', fn ($categoryQuery) => $categoryQuery->where('name', 'like', '%' . $term . '%'));
                });
            })
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->integer('category_id')))
            ->when($request->string('status')->toString() === 'available', fn ($query) => $query->where('is_available', true))
            ->when($request->string('status')->toString() === 'hidden', fn ($query) => $query->where('is_available', false))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.menu-items.index', [
            'items' => $items,
            'filterCategories' => $this->categoryOptions(),
        ]);
    }

    public function create(): View
    {
        return view('admin.menu-items.create', [
            'menuItem' => new MenuItem([
                'is_available' => true,
                'sort_order' => 0,
            ]),
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function store(MenuItemRequest $request): RedirectResponse
    {
        MenuItem::create($this->payload($request));

        return redirect()
            ->route('admin.menu-items.index')
            ->with('status', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menuItem): View
    {
        return view('admin.menu-items.edit', [
            'menuItem' => $menuItem,
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem): RedirectResponse|JsonResponse
    {
        $menuItem->update($this->payload($request, $menuItem));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Menu item updated successfully.',
                'data' => [
                    'id' => $menuItem->id,
                    'is_available' => (bool) $menuItem->is_available,
                ],
            ]);
        }

        if ($request->filled('redirect_to')) {
            return redirect((string) $request->input('redirect_to'))
                ->with('status', 'Menu item updated successfully.');
        }

        return redirect()
            ->route('admin.menu-items.index')
            ->with('status', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }

        $menuItem->delete();

        return redirect()
            ->route('admin.menu-items.index')
            ->with('status', 'Menu item deleted successfully.');
    }

    protected function payload(MenuItemRequest $request, ?MenuItem $menuItem = null): array
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['name'], $menuItem?->id);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_available'] = $request->boolean('is_available');

        if ($request->hasFile('image')) {
            if ($menuItem?->image_path) {
                Storage::disk('public')->delete($menuItem->image_path);
            }

            $data['image_path'] = $request->file('image')->store('menu-items', 'public');
        }

        unset($data['image']);

        return $data;
    }

    protected function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug !== '' ? $baseSlug : 'menu-item';
        $counter = 2;

        while (
            MenuItem::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = ($baseSlug !== '' ? $baseSlug : 'menu-item') . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function categoryOptions()
    {
        return MenuCategory::where('is_active', true)
            ->with('parent')
            ->orderByRaw('COALESCE(parent_id, id)')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
