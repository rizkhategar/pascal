<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailDosen;
use App\Http\Resources\DosenIndexResource;
use App\Http\Resources\DosenSintaResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DosenApiController extends Controller
{
    /**
     * Get Daftar Data Dosen Tersedia
     * * Mengambil semua daftar dosen esensial di tabel detail_dosen.
     */
    public function index(): AnonymousResourceCollection
    {
        $dosens = DetailDosen::select(['sinta_id', 'nama', 'program_studi', 'bidang_minat', 'profile_photo'])->get();

        return DosenIndexResource::collection($dosens);
    }

    /**
     * Get Detail SINTA Dosen Spesifik (Komplit)
     * * Mengambil ringkasan skor matriks SINTA lengkap, statistik grafik tahunan,
     * serta seluruh isi data publikasi (Scopus, Scholar, Garuda), penelitian, pengabdian, dan buku.
     */
    public function show(string $sinta_id): DosenSintaResource
    {
        $dosen = DetailDosen::with([
            // 1. Relasi untuk data statistik grafik tahunan
            'scopusYearlyStats',
            'scholarYearlyStats',
            'garudaYearlyStats',
            'researchYearlies',
            'serviceYearlies',
            
            // 2. Relasi untuk detail isi konten publikasi & riwayat kegiatan lengkap
            'scopusPublications',
            'scholarPublications',
            'garudaPublications',
            'books',
            'researches',
            'services'
        ])->findOrFail($sinta_id);

        return new DosenSintaResource($dosen);
    }
}