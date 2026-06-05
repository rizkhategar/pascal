<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    // Tambahkan judul_visi dan judul_misi ke sini
    protected $fillable = [
        'judul_visi',
        'visi',
        'judul_misi',
        'misi',
    ];
}