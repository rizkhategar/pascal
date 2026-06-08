<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    // Tambahkan judul_visi dan judul_misi ke sini
    protected $fillable = [
        'hero_title',          
        'hero_subtitle',       
        'hero_image',
        'judul_visi',
        'visi',
        'judul_misi',
        'misi',
        'judul_tujuan',         
        'tujuan',               
        'judul_tujuan_bidang',  
        'tujuan_bidang',        
        'judul_sasaran_target', 
        'sasaran_target',       
    ];
}