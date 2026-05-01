<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'arrival_date',
        'departure_date',
        'adults',
        'children',
        'room_category',
        'message',
        'agreed_to_terms',
    ];

    protected function casts(): array
    {
        return [
            'arrival_date' => 'date',
            'departure_date' => 'date',
            'agreed_to_terms' => 'boolean',
        ];
    }
}
