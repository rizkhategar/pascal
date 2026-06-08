<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara spesifik
    protected $table = 'dosen';

    // Mendefinisikan kolom yang boleh diisi (mass-assignment)
    protected $fillable = [
        'nama',
        'sinta_id',
        'departemen',
        'scopus_h_index',
        'google_scholar_h_index',
        'sinta_score_3yr',
        'sinta_score',
        'affiliation_score_3yr',
        'affiliation_score',
        'profile_url',
    ];
}