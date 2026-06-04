<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramApplicationStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'step_number',
        'title',
        'description',
    ];

    // Relasi balik ke AcademicProgram
    public function program()
    {
        return $this->belongsTo(AcademicProgram::class, 'program_id');
    }
}