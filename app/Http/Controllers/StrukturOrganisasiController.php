<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::query()
            ->where('is_active', true)
            ->whereNotNull('image_path')
            ->latest('updated_at')
            ->latest('id')
            ->first();

        return view('profil.struktur-organisasi', compact('strukturOrganisasi'));
    }
}
