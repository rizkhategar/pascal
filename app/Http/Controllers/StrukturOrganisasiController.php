<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use Illuminate\View\View;

class StrukturOrganisasiController extends Controller
{
    public function index(): View
    {
        $strukturOrganisasi = StrukturOrganisasi::query()
            ->where('is_active', true)
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '')
            ->latest('updated_at')
            ->latest('id')
            ->first();

        if (! $strukturOrganisasi) {
            $strukturOrganisasi = StrukturOrganisasi::query()
                ->whereNotNull('image_path')
                ->where('image_path', '!=', '')
                ->latest('updated_at')
                ->latest('id')
                ->first();
        }

        return response()
            ->view('profil.struktur-organisasi', compact('strukturOrganisasi'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
