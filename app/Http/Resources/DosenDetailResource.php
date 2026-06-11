<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // BARIS 10: Pastikan menggunakan $request
    public function toArray(Request $request): array
    {
        return [
            'sinta_id' => $this->sinta_id,
            'nama' => $this->nama,
            'program_studi' => $this->program_studi,
            'bidang_minat' => $this->bidang_minat,
            'profile_photo_url' => $this->profile_photo ? asset('assets/images/' . $this->profile_photo) : null,
            'list_publikasi' => [
                'scopus' => $this->whenLoaded('scopusPublications'),
                'scholar' => $this->whenLoaded('scholarPublications'),
                'garuda' => $this->whenLoaded('garudaPublications'),
            ],
            'list_kegiatan' => [
                'penelitian' => $this->whenLoaded('researches'),
                'pengabdian' => $this->whenLoaded('services'),
                'buku' => $this->whenLoaded('books'),
            ]
        ];
    }
}