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
        * List Dosen Pasca
        */ 
    public function index(): AnonymousResourceCollection
    {
        $dosens = DetailDosen::select(['sinta_id', 'nama', 'program_studi', 'bidang_minat', 'profile_photo'])->get();
        return DosenIndexResource::collection($dosens);
    }

    /**
     *Detail SINTA Dosen 
     */
    public function show(string $sinta_id, ?string $type = null): DosenSintaResource
    {
        // 1. Relasi default jika tipe tidak diisi (Load Semua Data)
        $relations = [
            'scopusYearlyStats', 'scholarYearlyStats', 'garudaYearlyStats', 'researchYearlies', 'serviceYearlies',
            'scopusPublications', 'scholarPublications', 'garudaPublications', 'books', 'researches', 'services'
        ];

        // 2. Jika parameter tipe diisi, persempit relasi agar query super cepat
        if ($type) {
            $relations = match (strtolower($type)) {
                'scopus'   => ['scopusPublications', 'scopusYearlyStats'],
                'scholar'  => ['scholarPublications', 'scholarYearlyStats'],
                'garuda'   => ['garudaPublications', 'garudaYearlyStats'],
                'research' => ['researches', 'researchYearlies'],
                'service'  => ['services', 'serviceYearlies'],
                'books'    => ['books'],
                default    => $relations,
            };
        }

        // 3. Cari dosen hanya dengan relasi yang dipilih
        $dosen = DetailDosen::with($relations)->findOrFail($sinta_id);

        return new DosenSintaResource($dosen);
    }
}