<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuOrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'menu_item_id' => $this->menu_item_id,
            'item_name' => $this->item_name,
            'item_price' => $this->item_price,
            'quantity' => $this->quantity,
            'line_total' => $this->line_total,
        ];
    }
}
