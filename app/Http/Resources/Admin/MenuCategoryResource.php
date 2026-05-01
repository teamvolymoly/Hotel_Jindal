<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'parent_name' => $this->whenLoaded('parent', fn () => $this->parent?->name),
            'name' => $this->name,
            'slug' => $this->slug,
            'headline' => $this->headline,
            'sort_order' => $this->sort_order,
            'is_active' => (bool) $this->is_active,
            'items_count' => $this->whenCounted('items'),
            'children_count' => $this->whenLoaded('children', fn () => $this->children->count()),
            'full_name' => $this->fullName(),
            'created_at' => optional($this->created_at)?->toIso8601String(),
            'updated_at' => optional($this->updated_at)?->toIso8601String(),
        ];
    }
}
