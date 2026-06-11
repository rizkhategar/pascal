<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    // TAMBAHKAN BARIS INI: Pastikan namanya persis dengan yang ada di database/file migrasi Anda
    protected $table = 'sinta_researches'; 

    protected $guarded = []; // (Atau $fillable sesuai yang Anda gunakan)
}