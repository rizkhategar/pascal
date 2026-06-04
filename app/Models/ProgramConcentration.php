<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramConcentration extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'name',
        'if_condition',
        'then_outcome',
        'curriculum_link',
    ];

    // Relasi balik ke AcademicProgram
    public function program()
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }
}