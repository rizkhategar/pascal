<?php

namespace App\Filament\Resources\DetailDosens\Pages;

use App\Filament\Resources\DetailDosens\DetailDosenResource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\DaftarDosen; // <--- 1. PASTIKAN MODEL INI SUDAH DI-IMPORT

class ImportDetailDosen extends Page
{
    protected static string $resource = DetailDosenResource::class;

    protected string $view = 'filament.resources.detail-dosens.pages.import-detail-dosen';

    protected static ?string $title = 'Import & Scraping SINTA';
    /**
     * Kirimkan data dinamis ke dalam View kustom khusus Import
     */
    public function getViewData(): array
    {
        // 2. GANTI LOGIKA PYTHON BACA_DOSEN LAMA DENGAN QUERY DATABASE INI
        // Mengambil semua dosen diurutkan berdasarkan abjad nama
        $dosenList = DaftarDosen::orderBy('nama', 'asc')->get();

        $excelExists = file_exists(base_path('scripts/output/dosen_universitas_ngudi_waluyo.xlsx'));

        $jurusans = Cache::remember('academic_programs_nav', now()->addHours(12), function () {
            $response = Http::withoutVerifying()->get('https://panel-web.unw.ac.id/api/unw-program-studi');

            if (!$response->successful()) {
                return [];
            }

            return collect($response->json('data', []))
                ->filter(function ($item) {
                    return isset($item['slug'], $item['nama'], $item['unwFakultas']['nama']) 
                        && trim($item['unwFakultas']['nama']) === 'Pascasarjana';
                })
                ->map(function ($item) {
                    return [
                        'slug' => $item['slug'],
                        'display_name' => trim(($item['jenjang'] ?? '') . ' ' . ($item['nama'] ?? '')),
                    ];
                })
                ->sortBy('display_name')
                ->values()
                ->toArray();
        });

        return [
            'jurusans' => $jurusans,
            'dosenList' => $dosenList, // <--- Variabel ini sekarang berisi Collection Object dari Database
            'excelExists' => $excelExists,
        ];
    }
}