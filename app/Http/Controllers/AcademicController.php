<?php

namespace App\Http\Controllers;

use App\Models\AcademicProgram;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    /**
     * Menampilkan halaman akademik berdasarkan slug program magister.
     */
    public function show($slug)
    {
        // Mencari program berdasarkan slug (misal: 'magister-hukum')
        // firstOrFail() akan otomatis menampilkan halaman 404 jika slug tidak ditemukan
        $program = AcademicProgram::with(['requirements', 'steps', 'concentrations'])
                    ->where('slug', $slug)
                    ->firstOrFail();

        // Mengirimkan data program ke view akademik.blade.php
        return view('akademik', compact('program'));
    }
}