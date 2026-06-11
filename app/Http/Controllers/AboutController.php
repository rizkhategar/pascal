<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPascasarjana; 

class AboutController extends Controller
{
    public function index()
    {
        // Ubah nama variabel menjadi $tentang agar sesuai dengan yang diminta file Blade
        $tentang = AboutPascasarjana::first();
        
        // Kirimkan variabel $tentang ke view 'about'
        return view('about', compact('tentang'));
    }
}