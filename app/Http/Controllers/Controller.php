<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function __construct()
    {
        $response = Http::withoutVerifying()
            ->get('https://panel-web.unw.ac.id/api/unw-program-studi');

        $academicProgramsNav = collect($response->json())
            ->filter(function ($item) {
                return isset($item['unwFakultas']['nama'])
                    && trim($item['unwFakultas']['nama']) === 'Pascasarjana';
            })
            ->map(function ($item) {
                return [
                    'slug' => $item['slug'],
                    'display_name' => $item['jenjang_nama_singkat'] . ' ' . $item['nama'],
                ];
            })
            ->values();

        View::share('academicProgramsNav', $academicProgramsNav);
    }
}
