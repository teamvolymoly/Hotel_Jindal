<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuCategoryRequest;
use App\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = MenuCategory::with(['parent', 'children'])
            ->withCount('items')
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim((string) $request->string('q'));
                $query->where(function ($innerQuery) use ($term) {
                    $innerQuery->where('name', 'like', '%' . $term . '%')
                        ->orWhere('slug', 'like', '%' . $term . '%')
                        ->orWhereHas('parent', fn ($parentQuery) => $parentQuery->where('name', 'like', '%' . $term . '%'));
                });
            })
            ->when($request->string('type')->toString() === 'main', fn ($query) => $query->whereNull('parent_id'))
            ->when($request->string('type')->toString() === 'sub', fn ($query) => $query->whereNotNull('parent_id'))
            ->when($request->string('status')->toString() === 'active', fn ($query) => $query->where('is_active', true))
            ->when($request->string('status')->toString() === 'inactive', fn ($query) => $query->where('is_active', false))
            ->orderByRaw('COALESCE(parent_id, id)')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.menu-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.menu-categories.create', [
            'menuCategory' => new MenuCategory([
                'is_active' => true,
                'sort_order' => 0,
            ]),
            'parentCategories' => $this->parentCategories(),
        ]);
    }

    public function store(MenuCategoryRequest $request): RedirectResponse
    {
        MenuCategory::create($this->payload($request));

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('status', 'Menu category created successfully.');
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('admin.menu-categories.edit', [
            'menuCategory' => $menuCategory->load('parent'),
            'parentCategories' => $this->parentCategories($menuCategory),
        ]);
    }

    public function update(MenuCategoryRequest $request, MenuCategory $menuCategory): RedirectResponse|JsonResponse
    {
        $menuCategory->update($this->payload($request));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Menu category updated successfully.',
                'data' => [
                    'id' => $menuCategory->id,
                    'is_active' => (bool) $menuCategory->is_active,
                ],
            ]);
        }

        if ($request->filled('redirect_to')) {
            return redirect((string) $request->input('redirect_to'))
                ->with('status', 'Menu category updated successfully.');
        }

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('status', 'Menu category updated successfully.');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        if ($menuCategory->children()->exists()) {
            throw ValidationException::withMessages([
                'category' => 'Delete or move subcategories before deleting this category.',
            ]);
        }

        if ($menuCategory->items()->exists()) {
            throw ValidationException::withMessages([
                'category' => 'Delete or move menu items before deleting this category.',
            ]);
        }

        $menuCategory->delete();

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('status', 'Menu category deleted successfully.');
    }

    protected function payload(MenuCategoryRequest $request): array
    {
        $data = $request->validated();
        $data['parent_id'] = $data['parent_id'] ?? null;
        $data['slug'] = $this->uniqueSlug($data['name'], $request->route('menu_category')?->id);
        $data['headline'] = $data['name'];
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    protected function parentCategories(?MenuCategory $currentCategory = null)
    {
        return MenuCategory::query()
            ->whereNull('parent_id')
            ->when($currentCategory, fn ($query) => $query->whereKeyNot($currentCategory->id))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    protected function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug !== '' ? $baseSlug : 'category';
        $counter = 2;

        while (
            MenuCategory::query()
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = ($baseSlug !== '' ? $baseSlug : 'category') . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
