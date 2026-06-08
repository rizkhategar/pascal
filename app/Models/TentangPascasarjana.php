<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangPascasarjana extends Model
{
    protected $fillable = [
        'hero_image',
        'subheading',
        'heading',
        'description',
        'points',
        'direktur_heading',  
        'direktur_greeting',
        'direktur_name',    
        'direktur_title',   
        'direktur_image',   
        'direktur_message', 
    ];

    protected $casts = [
        'points' => 'array', // Cast JSON ke Array
    ];
}