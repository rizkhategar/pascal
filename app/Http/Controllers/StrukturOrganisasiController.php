<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::query()
            ->where('is_active', true)
            ->latest()
            ->first();

        return view('profil.struktur-organisasi', compact('strukturOrganisasi'));
    }
}
