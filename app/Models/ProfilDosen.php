<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDosen extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'profil_dosen';

    // Kolom yang diizinkan untuk diisi secara massal (mass assignment)
    protected $fillable = [
        'id_sinta',
        'nama_dosen',
        'prodi',
        'profile',
    ];
}