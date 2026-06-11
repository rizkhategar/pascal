<?php

namespace App\Http\Controllers;

use App\Models\DetailDosen;
use Illuminate\Http\Request;

class RisetController extends Controller
{
    public function listDosen(Request $request)
    {
        // Ambil data navigasi untuk filter jurusan
        $academicProgramsNav = \App\Http\Controllers\AcademicController::getNavigationData();

        // Query data dosen
        $query = DetailDosen::query();

        // Logika Pencarian Nama / SINTA ID
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('sinta_id', 'like', '%' . $request->search . '%');
            });
        }

        // Logika Filter Jurusan/Program Studi
        if ($request->has('jurusan') && $request->jurusan != '') {
            $query->where('jurusan', $request->jurusan);
        }

        // Pagination data dosen
        $dosens = $query->paginate(10);

        // Kembalikan ke view TANPA membawa variabel heroSlides
        return view('riset&pdm.listrisetdosen', compact('dosens', 'academicProgramsNav'));
    }

    public function detailDosen($sinta_id)
    {
        // Mengambil data dosen beserta relasi publikasi & buku saja (mengoptimalkan performa)
        $dosen = DetailDosen::with([
            'scopusPublications',
            'scopusYearlyStats',
            'scholarPublications',
            'scholarYearlyStats',
            'garudaPublications',
            'garudaYearlyStats',
            'books'
        ])->findOrFail($sinta_id);

        // Memperbaiki path view agar mengarah ke folder resources/views/riset&pdm/detailriset.blade.php
        return view('riset&pdm.detailriset', compact('dosen'));
    }
}
