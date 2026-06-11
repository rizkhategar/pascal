<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailDosen extends Model
{
    // Mengatur nama tabel jika tidak mengikuti aturan jamak Laravel (opsional)
    protected $table = 'sinta_detail_dosens';

    // Mengonfigurasi sinta_id sebagai Primary Key non-incrementing string
    protected $primaryKey = 'sinta_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Mengizinkan mass assignment untuk mempermudah import data
    protected $guarded = [];

    /**
     * Relasi ke Data Penelitian (Researches)
     */
    public function researches(): HasMany
    {
        return $this->hasMany(Research::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Statistik Tahunan Penelitian (Research Yearly)
     */
    public function researchYearlies(): HasMany
    {
        return $this->hasMany(ResearchYearly::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Data Pengabdian (Services)
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Statistik Tahunan Pengabdian (Service Yearly)
     */
    public function serviceYearlies(): HasMany
    {
        return $this->hasMany(ServiceYearly::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Data Buku (Books)
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Publikasi Garuda (Garuda Publications)
     */
    public function garudaPublications(): HasMany
    {
        return $this->hasMany(GarudaPublication::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Statistik Tahunan Garuda (Garuda Yearly Stats)
     */
    public function garudaYearlyStats(): HasMany
    {
        return $this->hasMany(GarudaYearlyStat::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Publikasi Google Scholar (Scholar Publications)
     */
    public function scholarPublications(): HasMany
    {
        return $this->hasMany(ScholarPublication::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Statistik Tahunan Google Scholar (Scholar Yearly Stats)
     */
    public function scholarYearlyStats(): HasMany
    {
        return $this->hasMany(ScholarYearlyStat::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Publikasi Scopus (Scopus Publications)
     */
    public function scopusPublications(): HasMany
    {
        return $this->hasMany(ScopusPublication::class, 'sinta_id', 'sinta_id');
    }

    /**
     * Relasi ke Statistik Tahunan Scopus (Scopus Yearly Stats)
     */
    public function scopusYearlyStats(): HasMany
    {
        return $this->hasMany(ScopusYearlyStat::class, 'sinta_id', 'sinta_id');
    }
}