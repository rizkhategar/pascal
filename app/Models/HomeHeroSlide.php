<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSlide extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image_path',
        'sort_order',
        'duration_ms',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'duration_ms' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
