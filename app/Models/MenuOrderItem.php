<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_order_id',
        'menu_item_id',
        'item_name',
        'item_price',
        'quantity',
        'line_total',
    ];

    protected function casts(): array
    {
        return [
            'item_price' => 'decimal:2',
            'line_total' => 'decimal:2',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(MenuOrder::class, 'menu_order_id');
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
