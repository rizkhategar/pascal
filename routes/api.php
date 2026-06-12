<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DosenApiController;


Route::get('/data-sinta', [DosenApiController::class, 'index'])
     ->name('api.dosen.index');

// GET /api/data-sinta/{sinta_id} -> Dapatkan detail matriks & grafik SINTA dosen spesifik
Route::get('/data-sinta/{sinta_id}/{type?}', [DosenApiController::class, 'show'])
     ->name('api.dosen.show');