<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Beverages', 'headline' => 'Cold Pressed Juices', 'sort_order' => 1],
            ['name' => 'Soups', 'headline' => 'Fresh Soups', 'sort_order' => 2],
            ['name' => 'Starters', 'headline' => 'Signature Starters', 'sort_order' => 3],
            ['name' => 'Main Course', 'headline' => 'Main Course', 'sort_order' => 4],
            ['name' => 'Roti', 'headline' => 'Roti Selection', 'sort_order' => 5],
            ['name' => 'Curds', 'headline' => 'Curds & Sides', 'sort_order' => 6],
            ['name' => 'Papads', 'headline' => 'Papad Collection', 'sort_order' => 7],
        ];

        foreach ($categories as $category) {
            MenuCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                $category + ['is_active' => true]
            );
        }

        $beverages = MenuCategory::where('slug', 'beverages')->first();

        if (! $beverages) {
            return;
        }

        $items = [
            [
                'name' => 'Minty Sunshine',
                'price' => 190,
                'sort_order' => 1,
            ],
            [
                'name' => 'Energy Booster',
                'price' => 210,
                'sort_order' => 2,
            ],
        ];

        foreach ($items as $item) {
            MenuItem::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                $item + [
                    'category_id' => $beverages->id,
                    'is_available' => true,
                ]
            );
        }
    }
}
