<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guest_name' => $this->guest_name,
            'room_no' => $this->room_no,
            'phone' => $this->phone,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'items_count' => $this->whenCounted('items'),
            'items' => $this->whenLoaded('items', fn () => MenuOrderItemResource::collection($this->items)->resolve()),
            'created_at' => optional($this->created_at)?->toIso8601String(),
            'updated_at' => optional($this->updated_at)?->toIso8601String(),
        ];
    }
}
