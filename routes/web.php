<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\StrukturOrganisasiUploadController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\Admin\HomeHeroSlideUploadController;
use App\Http\Controllers\ScrapController;
use App\Models\HomeHeroSlide;
use App\Models\StrukturOrganisasi;
use App\Http\Controllers\RisetController;

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

    return response()
        ->file(Storage::disk('public')->path($homeHeroSlide->image_path), [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
})->name('hero-campus.image');

Route::get('/struktur-organisasi-image/{strukturOrganisasi}', function (StrukturOrganisasi $strukturOrganisasi) {
    abort_unless($strukturOrganisasi->image_path, 404);
    abort_unless(Storage::disk('public')->exists($strukturOrganisasi->image_path), 404);

    return response()
        ->file(Storage::disk('public')->path($strukturOrganisasi->image_path), [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
})->name('struktur-organisasi.image');

Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/akademik/{slug}', [AcademicController::class, 'show'])->name('akademik.show');

Route::get('/akademik/magister-hukum', function () {
    return view('akademik');
})->name('akademik.hukum');

Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
Route::get('/profil/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('profil.struktur-organisasi');

Route::get('/tentang-pascasarjana', [TentangController::class, 'index'])->name('tentang');

// Route untuk menampilkan halaman utama panel scrap
Route::get('/scrap/ambildatadosen', [ScrapController::class, 'index'])->name('scrap.index');

// Route SSE Stream untuk menjalankan dosen.py
Route::get('/scrap/perbarui-dosen', [ScrapController::class, 'perbaruiDosen'])->name('scrap.perbaruiDosen');

// Route SSE Stream untuk menjalankan 6 script detail + merge
Route::get('/scrap/ambil-detail/{sinta_id}', [ScrapController::class, 'ambilDetail'])->name('scrap.ambilDetail');
// Pastikan ini Route::get, BUKAN Route::post
Route::get('/scrap/import/{sinta_id}', [App\Http\Controllers\ScrapController::class, 'importData'])->name('scrap.importData');

Route::get('/riset-dosen', [RisetController::class, 'listDosen'])->name('riset.dosen');
Route::get('/riset-dosen/detail/{sinta_id}', [RisetController::class, 'detailDosen'])->name('riset.detail');

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
