<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\StrukturOrganisasiController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/akademik/{slug}', [AcademicController::class, 'show'])->name('akademik.show');

Route::get('/akademik/magister-hukum', function () {
    // Pastikan file akademik.blade.php berada di dalam folder resources/views/
    return view('akademik'); 
})->name('akademik.hukum');

Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/profil/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('profil.struktur-organisasi');
