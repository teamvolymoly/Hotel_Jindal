<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuPageController extends Controller
{
    public function __invoke(Request $request): View
    {
        $categories = MenuCategory::where('is_active', true)
            ->with(['items' => fn ($query) => $query->where('is_available', true)])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $activeCategory = $categories->firstWhere('slug', $request->string('category')->toString()) ?: $categories->first();

        return view('pages.menu', [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'menuItems' => $activeCategory?->items ?? collect(),
        ]);
    }
}
