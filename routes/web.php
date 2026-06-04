<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiMisiController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/akademik/magister-hukum', function () {
    // Pastikan file akademik.blade.php berada di dalam folder resources/views/
    return view('akademik'); 
})->name('akademik.hukum');

Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');