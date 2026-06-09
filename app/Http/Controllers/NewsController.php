<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class NewsController extends Controller
{
    public function show(string $slug): View
    {
        return view('news.show', [
            'slug' => $slug,
        ]);
    }
}
