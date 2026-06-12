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

        // Pagination data dosen (Tepat 10 data per lembar halaman)
        $dosens = $query->paginate(10);

        // Kembalikan langsung ke view Blade
        return view('riset&pdm.listrisetdosen', compact('dosens', 'academicProgramsNav'));
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
            'books',
            'researches',
            'researchYearlies',
            'services',
            'serviceYearlies'
        ])->findOrFail($sinta_id);

        return view('riset&pdm.detailriset', compact('dosen'));
    }
}