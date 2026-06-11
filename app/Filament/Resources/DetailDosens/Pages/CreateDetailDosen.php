<?php

namespace App\Filament\Resources\DetailDosens\Pages;

use App\Filament\Resources\DetailDosens\DetailDosenResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CreateDetailDosen extends CreateRecord
{
    protected static string $resource = DetailDosenResource::class;

    // 1. Tentukan lokasi berkas Blade kustom untuk halaman ini
    protected string $view = 'filament.resources.detail-dosens.pages.create-detail-dosen';

    /**
     * 2. Kirimkan data dinamis ($dosenList & $excelExists) ke dalam View kustom
     * Sama persis seperti logika pada ScrapController@index
     */
    protected function getViewData(): array
    {
        $pythonExe = 'python'; // Sesuaikan jika menggunakan path penuh Windows
        $scriptPath = base_path('scripts/baca_dosen.py');
        $dosenList = [];

        if (file_exists($scriptPath)) {
            $command = escapeshellcmd("{$pythonExe} \"{$scriptPath}\"");
            $jsonData = shell_exec($command);
            if ($jsonData) {
                $dosenList = json_decode($jsonData, true);
            }
        }

        $excelExists = file_exists(base_path('scripts/output/dosen_universitas_ngudi_waluyo.xlsx'));

        $jurusans = Cache::remember('academic_programs_nav', now()->addHours(12), function () {
            $response = Http::withoutVerifying()->get('https://panel-web.unw.ac.id/api/unw-program-studi');

            if (!$response->successful()) {
                return [];
            }

            return collect($response->json('data', []))
                ->filter(function ($item) {
                    return isset(
                        $item['slug'],
                        $item['nama'],
                        $item['unwFakultas']['nama']
                    ) && trim($item['unwFakultas']['nama']) === 'Pascasarjana';
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
            'dosenList' => $dosenList,
            'excelExists' => $excelExists,
        ];
    }
}