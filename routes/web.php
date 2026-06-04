<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/akademik/{slug}', [AcademicController::class, 'show'])->name('akademik.show');

Route::get('/akademik/magister-hukum', function () {
    // Pastikan file akademik.blade.php berada di dalam folder resources/views/
    return view('akademik'); 
})->name('akademik.hukum');