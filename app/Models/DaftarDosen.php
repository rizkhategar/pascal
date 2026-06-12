<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarDosen extends Model
{
    use HasFactory;

    protected $table = 'daftar_dosen';

    protected $primaryKey = 'sinta_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'sinta_id',
        'nama',
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