<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AcademicController extends Controller
{
    private static array $programOrder = [
        'magister-keperawatan',
        'magister-kesehatan-masyarakat',
        'magister-manajemen-pendidikan',
        'magister-hukum',
    ];

    public static function getNavigationData(): array
    {
        return Cache::remember('academic_programs_nav', now()->addHours(12), function () {
            $response = Http::withoutVerifying()->get('https://panel-web.unw.ac.id/api/unw-program-studi');

            if (! $response->successful()) {
                return [];
            }

            return collect($response->json('data', []))
                ->filter(function ($item) {
                    return isset($item['slug'], $item['unwFakultas']['nama'])
                        && trim($item['unwFakultas']['nama']) === 'Pascasarjana';
                })
                ->map(function ($item) {
                    return [
                        'slug' => $item['slug'],
                        'display_name' => trim(($item['jenjang'] ?? '') . ' ' . ($item['nama'] ?? '')),
                    ];
                })
                ->sortBy(fn ($item) => array_search($item['slug'], self::$programOrder, true) !== false
                    ? array_search($item['slug'], self::$programOrder, true)
                    : 99)
                ->values()
                ->toArray();
        });
    }

    public function show(string $slug)
    {
        $response = Http::withoutVerifying()->get("https://panel-web.unw.ac.id/api/unw-program-studi-page/{$slug}");
        $academicProgramsNav = self::getNavigationData();

        if ($response->successful() && $response->json('data')) {
            $program = $response->json('data');

            return view('akademik', compact('program', 'academicProgramsNav'));
        }

        abort(404, 'Program Studi tidak ditemukan.');
    }
}
