<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeHeroSlideUploadController extends Controller
{
    public function create(): View
    {
        return view('admin.home-hero-slides.create');
    }

    public function edit(HomeHeroSlide $homeHeroSlide): View
    {
        return view('admin.home-hero-slides.edit', compact('homeHeroSlide'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $path = $request->file('image')->storeAs(
            'home-hero-slides',
            $this->makeFileName($request->file('image')->getClientOriginalExtension()),
            'public'
        );

        HomeHeroSlide::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'image_path' => $path,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->to('/admin/home-hero-slides')
            ->with('success', 'Hero Campus berhasil ditambahkan.');
    }

    public function update(Request $request, HomeHeroSlide $homeHeroSlide): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($homeHeroSlide->image_path && Storage::disk('public')->exists($homeHeroSlide->image_path)) {
                Storage::disk('public')->delete($homeHeroSlide->image_path);
            }

            $data['image_path'] = $request->file('image')->storeAs(
                'home-hero-slides',
                $this->makeFileName($request->file('image')->getClientOriginalExtension()),
                'public'
            );
        }

        $homeHeroSlide->update($data);

        return redirect()
            ->to('/admin/home-hero-slides')
            ->with('success', 'Hero Campus berhasil diperbarui.');
    }

    private function makeFileName(string $extension): string
    {
        return 'hero-campus-' . now()->format('YmdHis') . '-' . Str::random(8) . '.' . strtolower($extension);
    }
}
