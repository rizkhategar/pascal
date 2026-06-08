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
    ];

    protected $casts = [
        'points' => 'array', // Cast JSON ke Array
    ];
}