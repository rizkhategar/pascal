<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\Admin\StrukturOrganisasiUploadController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\Admin\HomeHeroSlideUploadController;
use App\Models\HomeHeroSlide;
use App\Models\StrukturOrganisasi;

Route::get('/', function () {
    $heroSlides = HomeHeroSlide::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->oldest('id')
        ->get();

    return view('home', compact('heroSlides'));
})->name('home');

Route::get('/hero-campus/{homeHeroSlide}/image', function (HomeHeroSlide $homeHeroSlide) {
    abort_unless($homeHeroSlide->image_path, 404);
    abort_unless(Storage::disk('public')->exists($homeHeroSlide->image_path), 404);

    return response()->file(Storage::disk('public')->path($homeHeroSlide->image_path));
})->name('hero-campus.image');

Route::get('/struktur-organisasi-image/{strukturOrganisasi}', function (StrukturOrganisasi $strukturOrganisasi) {
    abort_unless($strukturOrganisasi->image_path, 404);
    abort_unless(Storage::disk('public')->exists($strukturOrganisasi->image_path), 404);

    return response()->file(Storage::disk('public')->path($strukturOrganisasi->image_path));
})->name('struktur-organisasi.image');

Route::get('/akademik/{slug}', [AcademicController::class, 'show'])->name('akademik.show');

Route::get('/akademik/magister-hukum', function () {
    return view('akademik');
})->name('akademik.hukum');

Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/profil/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('profil.struktur-organisasi');

Route::get('/tentang-pascasarjana', [TentangController::class, 'index'])->name('tentang');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin/struktur-organisasis/custom-create', [StrukturOrganisasiUploadController::class, 'create'])->name('admin.struktur-organisasi-upload.create');
    Route::get('/admin/struktur-organisasis/{strukturOrganisasi}/custom-edit', [StrukturOrganisasiUploadController::class, 'edit'])->name('admin.struktur-organisasi-upload.edit');
    Route::post('/admin/struktur-organisasis/upload', [StrukturOrganisasiUploadController::class, 'store'])->name('admin.struktur-organisasi-upload.store');
    Route::put('/admin/struktur-organisasis/{strukturOrganisasi}/upload', [StrukturOrganisasiUploadController::class, 'update'])->name('admin.struktur-organisasi-upload.update');

    Route::get('/admin/home-hero-slides/custom-create', [HomeHeroSlideUploadController::class, 'create'])->name('admin.home-hero-slides.create-custom');
    Route::get('/admin/home-hero-slides/{homeHeroSlide}/custom-edit', [HomeHeroSlideUploadController::class, 'edit'])->name('admin.home-hero-slides.edit-custom');
    Route::post('/admin/home-hero-slides/upload', [HomeHeroSlideUploadController::class, 'store'])->name('admin.home-hero-slides.store-custom');
    Route::put('/admin/home-hero-slides/{homeHeroSlide}/upload', [HomeHeroSlideUploadController::class, 'update'])->name('admin.home-hero-slides.update-custom');
});
