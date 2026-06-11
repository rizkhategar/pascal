<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // Wajib ditambahkan untuk fungsi Cache

class AcademicController extends Controller
{
    public static function getNavigationData()
    {
        return Cache::remember('academic_programs_nav', now()->addHours(12), function () {
            $responseNav = Http::withoutVerifying()->get('https://panel-web.unw.ac.id/api/unw-program-studi');
            if (!$responseNav->successful()) return [];
            return collect($responseNav->json('data', []))->filter(function ($item) {
                return isset($item['slug'], $item['unwFakultas']['nama']) && trim($item['unwFakultas']['nama']) === 'Pascasarjana';
            })->map(function ($item) {
                return [
                    'slug' => $item['slug'],
                    'display_name' => trim(($item['jenjang'] ?? '') . ' ' . ($item['nama'] ?? ''))
                ];
            })->sortBy('display_name')->values()->toArray();
        });
    }
    
    public function show($slug)
    {
        $response = Http::withoutVerifying()->get("https://panel-web.unw.ac.id/api/unw-program-studi-page/{$slug}");

        $academicProgramsNav = Cache::remember(
            'academic_programs_nav',
            now()->addHours(12),
            function () {
                $responseNav = Http::withoutVerifying()->get('https://panel-web.unw.ac.id/api/unw-program-studi');

                if (!$responseNav->successful()) {
                    return [];
                }

                return collect($responseNav->json('data', []))
                    ->filter(function ($item) {
                        return isset(
                            $item['slug'],
                            $item['nama'],
                            $item['jenjang_nama_singkat'],
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
            }
        );

        // Jika request data halaman sukses
        if ($response->successful() && $response->json('data')) {
            $program = $response->json('data');
            
            // 3. Passing kedua variabel ke view
            return view('akademik', compact('program', 'academicProgramsNav'));
        }

        abort(404, 'Program Studi tidak ditemukan.');
    }
}