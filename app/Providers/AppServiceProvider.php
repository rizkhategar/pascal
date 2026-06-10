<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $academicProgramsNav = Cache::remember(
                'academic_programs_nav',
                now()->addHours(12),
                function () {

                    $response = Http::withoutVerifying()
                        ->get('https://panel-web.unw.ac.id/api/unw-program-studi');

                    if (!$response->successful()) {
                        return [];
                    }

                    return collect($response->json('data', []))
                        ->filter(function ($item) {

                            return isset(
                                $item['slug'],
                                $item['nama'],
                                $item['jenjang_nama_singkat'],
                                $item['unwFakultas']['nama']
                            ) &&
                                trim($item['unwFakultas']['nama']) === 'Pascasarjana';
                        })
                        ->map(function ($item) {
                            return [
                                'slug' => $item['slug'],
                                'display_name' => trim(
                                    ($item['jenjang'] ?? '') . ' ' . ($item['nama'] ?? '')
                                ),
                            ];
                        })
                        ->sortBy('display_name')
                        ->values()
                        ->toArray();
                }
            );

            $view->with('academicProgramsNav', $academicProgramsNav);
        });
    }
}
