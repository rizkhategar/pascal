<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangPascasarjana extends Model
{
    protected $fillable = [
        'subheading',
        'heading',
        'description',
        'points',
        'direktur_image',   // Tambahan baru
        'direktur_name',    // Tambahan baru
        'direktur_title',   // Tambahan baru
        'direktur_message', // Tambahan baru
    ];

    protected $casts = [
        'points' => 'array', // Cast JSON ke Array
    ];
}