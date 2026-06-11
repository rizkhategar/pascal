<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailDosen;
use App\Models\HomeHeroSlide;

class RisetController extends Controller
{
    public function listDosen(Request $request)
    {
        // Ambil data Hero Slide untuk Banner Atas
        $heroSlides = HomeHeroSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Query Detail Dosen
        $query = DetailDosen::query();

        // Filter pencarian berdasarkan Nama atau SINTA ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('sinta_id', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan nama Jurusan
        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        // Paginasi menampilkan 10 data dosen per halaman
        $dosens = $query->paginate(10);

        // Memanggil file dari folder riset&pdm/listrisetdosen.blade.php
        return view('riset&pdm.listrisetdosen', compact('heroSlides', 'dosens'));
    }

    public function detailDosen($sinta_id)
    {
        $dosen = DetailDosen::with([
            'scopusPublications',
            'scopusYearlyStats',
            'scholarPublications',
            'scholarYearlyStats',
            'garudaPublications',
            'garudaYearlyStats',
            'books'
        ])->findOrFail($sinta_id);

        return view('detailriset', compact('dosen'));
    }
}
