<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'requirement_text',
        'sort_order',
    ];

    // Relasi balik ke AcademicProgram
    public function program()
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }
}