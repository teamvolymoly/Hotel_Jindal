<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'blog_tag',
        'slug',
        'excerpt',
        'content',
        'image_path',
        'image_caption',
        'status',
        'published_at',
        'author_id',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        return Route::has('media.public')
            ? route('media.public', ['path' => $this->image_path])
            : null;
    }
}
