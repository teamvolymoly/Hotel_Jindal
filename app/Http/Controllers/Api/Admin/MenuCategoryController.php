<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuCategoryRequest;
use App\Http\Resources\Admin\MenuCategoryResource;
use App\Models\MenuCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class MenuCategoryController extends Controller
{
    public function index(): mixed
    {
        $categories = MenuCategory::with(['parent', 'children'])
            ->withCount('items')
            ->orderByRaw('COALESCE(parent_id, id)')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        return MenuCategoryResource::collection($categories);
    }

    public function parentOptions(): JsonResponse
    {
        $categories = MenuCategory::query()
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'data' => MenuCategoryResource::collection($categories)->resolve(),
        ]);
    }

    public function store(MenuCategoryRequest $request): JsonResponse
    {
        $category = MenuCategory::create($this->payload($request));

        return response()->json([
            'message' => 'Menu category created successfully.',
            'data' => new MenuCategoryResource($category->load(['parent', 'children'])->loadCount('items')),
        ], 201);
    }

    public function show(MenuCategory $menuCategory): JsonResponse
    {
        return response()->json([
            'data' => new MenuCategoryResource($menuCategory->load(['parent', 'children'])->loadCount('items')),
        ]);
    }

    public function update(MenuCategoryRequest $request, MenuCategory $menuCategory): JsonResponse
    {
        $menuCategory->update($this->payload($request));

        return response()->json([
            'message' => 'Menu category updated successfully.',
            'data' => new MenuCategoryResource($menuCategory->fresh()->load(['parent', 'children'])->loadCount('items')),
        ]);
    }

    public function destroy(MenuCategory $menuCategory): JsonResponse
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

        return response()->json([
            'message' => 'Menu category deleted successfully.',
        ]);
    }

    protected function payload(MenuCategoryRequest $request): array
    {
        $data = $request->validated();
        $data['parent_id'] = $data['parent_id'] ?? null;
        $data['slug'] = $this->uniqueSlug($data['name'], $request->route('menuCategory')?->id ?? $request->route('menu_category')?->id);
        $data['headline'] = $data['name'];
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
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
