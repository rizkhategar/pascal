<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TentangPascasarjana; // Panggil model

class TentangController extends Controller
{
    public function index()
    {
        // Ambil data pertama (karena kita setel cuma 1 data)
        $tentang = TentangPascasarjana::first();
        
        return view('tentang', compact('tentang'));
    }
}