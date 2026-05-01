<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuItemRequest;
use App\Http\Resources\Admin\MenuCategoryResource;
use App\Http\Resources\Admin\MenuItemResource;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    public function index(): mixed
    {
        $items = MenuItem::with('category.parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        return MenuItemResource::collection($items);
    }

    public function categoryOptions(): JsonResponse
    {
        $categories = MenuCategory::where('is_active', true)
            ->with('parent')
            ->orderByRaw('COALESCE(parent_id, id)')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'data' => MenuCategoryResource::collection($categories)->resolve(),
        ]);
    }

    public function store(MenuItemRequest $request): JsonResponse
    {
        $menuItem = MenuItem::create($this->payload($request));

        return response()->json([
            'message' => 'Menu item created successfully.',
            'data' => new MenuItemResource($menuItem->load('category.parent')),
        ], 201);
    }

    public function show(MenuItem $menuItem): JsonResponse
    {
        return response()->json([
            'data' => new MenuItemResource($menuItem->load('category.parent')),
        ]);
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem): JsonResponse
    {
        $menuItem->update($this->payload($request, $menuItem));

        return response()->json([
            'message' => 'Menu item updated successfully.',
            'data' => new MenuItemResource($menuItem->fresh()->load('category.parent')),
        ]);
    }

    public function destroy(MenuItem $menuItem): JsonResponse
    {
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }

        $menuItem->delete();

        return response()->json([
            'message' => 'Menu item deleted successfully.',
        ]);
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
}
