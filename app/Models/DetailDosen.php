<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailDosen extends Model
{
    protected $table = 'sinta_detail_dosens';
    protected $primaryKey = 'sinta_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    // PENTING: Menjamin data anak otomatis terhapus saat DetailDosen dihapus dari list Filament
    protected static function booted()
    {
        static::deleting(function ($dosen) {

            $imagePath = public_path("assets/images/{$dosen->sinta_id}.jpg");
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }

            $dosen->researches()->delete();
            $dosen->researchYearlies()->delete();
            $dosen->services()->delete();
            $dosen->serviceYearlies()->delete();
            $dosen->books()->delete();
            $dosen->garudaPublications()->delete();
            $dosen->garudaYearlyStats()->delete();
            $dosen->scholarPublications()->delete();
            $dosen->scholarYearlyStats()->delete();
            $dosen->scopusPublications()->delete();
            $dosen->scopusYearlyStats()->delete();
        });
    }

    // --- DAFTAR RELASI UTAMA & YEARLY STATS ---

    public function researches(): HasMany
    {
        return $this->hasMany(Research::class, 'sinta_id', 'sinta_id');
    }

    public function researchYearlies(): HasMany
    {
        return $this->hasMany(ResearchYearly::class, 'sinta_id', 'sinta_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'sinta_id', 'sinta_id');
    }

    public function serviceYearlies(): HasMany
    {
        return $this->hasMany(ServiceYearly::class, 'sinta_id', 'sinta_id');
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'sinta_id', 'sinta_id');
    }

    public function garudaPublications(): HasMany
    {
        return $this->hasMany(GarudaPublication::class, 'sinta_id', 'sinta_id');
    }

    public function garudaYearlyStats(): HasMany
    {
        return $this->hasMany(GarudaYearlyStat::class, 'sinta_id', 'sinta_id');
    }

    public function scholarPublications(): HasMany
    {
        return $this->hasMany(ScholarPublication::class, 'sinta_id', 'sinta_id');
    }

    public function scholarYearlyStats(): HasMany
    {
        return $this->hasMany(ScholarYearlyStat::class, 'sinta_id', 'sinta_id');
    }

    public function scopusPublications(): HasMany
    {
        return $this->hasMany(ScopusPublication::class, 'sinta_id', 'sinta_id');
    }

    public function scopusYearlyStats(): HasMany
    {
        return $this->hasMany(ScopusYearlyStat::class, 'sinta_id', 'sinta_id');
    }
}
