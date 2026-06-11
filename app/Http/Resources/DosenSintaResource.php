<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenSintaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sinta_id' => $this->sinta_id,
            'nama' => $this->nama,
            'program_studi' => $this->program_studi,
            'bidang_minat' => $this->bidang_minat,
            'profile_photo_url' => $this->profile_photo ? asset('assets/images/' . $this->profile_photo) : null,
            
            // Matriks Skor SINTA Utama
            'sinta_scores' => [
                'overall' => $this->sinta_score_overall ?? 0,
                '3_year' => $this->sinta_score_3yr ?? 0,
                'affil' => $this->affil_score ?? 0,
                'affil_3_year' => $this->affil_score_3yr ?? 0,
            ],
            
            // Data Koordinat Nilai untuk Render Grafik Tahunan
            'statistik_grafik_tahunan' => [
                'scopus' => $this->whenLoaded('scopusYearlyStats'),
                'scholar' => $this->whenLoaded('scholarYearlyStats'),
                'garuda' => $this->whenLoaded('garudaYearlyStats'),
                'penelitian' => $this->whenLoaded('researchYearlies'),
                'pengabdian' => $this->whenLoaded('serviceYearlies'),
            ],

            // DETAIL ISI KONTEN PUBLIKASI DOSEN (Tambahan Baru)
            'detail_publikasi' => [
                'scopus' => $this->whenLoaded('scopusPublications'),
                'scholar' => $this->whenLoaded('scholarPublications'),
                'garuda' => $this->whenLoaded('garudaPublications'),
            ],

            // DETAIL ISI KONTEN RIWAYAT KEGIATAN & KARYA (Tambahan Baru)
            'detail_kegiatan_dan_karya' => [
                'penelitian' => $this->whenLoaded('researches'),
                'pengabdian' => $this->whenLoaded('services'),
                'buku' => $this->whenLoaded('books'),
            ]
        ];
    }
}