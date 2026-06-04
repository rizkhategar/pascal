<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::firstOrCreate([]);
        return view('visi-misi', compact('visiMisi'));
    }
}