<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $categories = MenuCategory::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with([
                'items' => fn ($query) => $query->where('is_available', true),
                'children' => fn ($query) => $query
                    ->where('is_active', true)
                    ->with([
                        'items' => fn ($itemQuery) => $itemQuery->where('is_available', true),
                    ]),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'data' => [
                'categories' => $categories->map(function (MenuCategory $category): array {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'items' => $category->items->map(fn ($item): array => [
                            'id' => $item->id,
                            'name' => $item->name,
                            'slug' => $item->slug,
                            'price' => (float) $item->price,
                            'image_url' => $item->image_path ? asset('storage/' . $item->image_path) : null,
                        ])->values()->all(),
                        'subcategories' => $category->children->map(function (MenuCategory $subcategory): array {
                            return [
                                'id' => $subcategory->id,
                                'name' => $subcategory->name,
                                'slug' => $subcategory->slug,
                                'items' => $subcategory->items->map(fn ($item): array => [
                                    'id' => $item->id,
                                    'name' => $item->name,
                                    'slug' => $item->slug,
                                    'price' => (float) $item->price,
                                    'image_url' => $item->image_path ? asset('storage/' . $item->image_path) : null,
                                ])->values()->all(),
                            ];
                        })->values()->all(),
                    ];
                })->values()->all(),
            ],
        ]);
    }
}
