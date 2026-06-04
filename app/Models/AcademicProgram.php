<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'degree',
        'hero_title',
        'hero_desc',
        'hero_image',
        'overview_title',
        'overview_content',
        'overview_image',
    ];

    // Otomatis mengubah JSON string di DB menjadi Array PHP
    protected $casts = [
        'overview_content' => 'array',
    ];

    // Relasi ke ProgramRequirement (1 to Many)
    public function requirements()
    {
        // Diurutkan berdasarkan sort_order
        return $this->hasMany(ProgramRequirement::class, 'program_id')->orderBy('sort_order');
    }

    // Relasi ke ProgramApplicationStep (1 to Many)
    public function steps()
    {
        // Diurutkan berdasarkan step_number
        return $this->hasMany(ProgramApplicationStep::class, 'program_id')->orderBy('step_number');
    }

    // Relasi ke ProgramConcentration (1 to Many)
    public function concentrations()
    {
        return $this->hasMany(ProgramConcentration::class, 'program_id');
    }
}