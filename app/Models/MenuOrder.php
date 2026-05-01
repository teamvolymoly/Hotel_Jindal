<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class MenuOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_name',
        'room_no',
        'phone',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuOrderItem::class);
    }

    public function recalculateTotal(): void
    {
        $totalAmount = (float) $this->items()->sum(DB::raw('line_total'));

        $this->forceFill([
            'total_amount' => $totalAmount,
        ])->save();
    }
}
