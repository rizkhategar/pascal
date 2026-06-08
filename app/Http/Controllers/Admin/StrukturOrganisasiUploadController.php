<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StrukturOrganisasiUploadController extends Controller
{
    public function create(): View
    {
        return view('admin.struktur-organisasi.create');
    }

    public function edit(StrukturOrganisasi $strukturOrganisasi): View
    {
        return view('admin.struktur-organisasi.edit', compact('strukturOrganisasi'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $path = $request->file('image')->storeAs(
            'struktur-organisasi',
            $this->makeFileName($request->file('image')->getClientOriginalExtension()),
            'public'
        );

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            StrukturOrganisasi::query()->update(['is_active' => false]);
        }

        StrukturOrganisasi::create([
            'title' => $validated['title'],
            'image_path' => $path,
            'is_active' => $isActive,
        ]);

        return redirect()
            ->to('/admin/struktur-organisasis')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            StrukturOrganisasi::query()
                ->whereKeyNot($strukturOrganisasi->getKey())
                ->update(['is_active' => false]);
        }

        $data = [
            'title' => $validated['title'],
            'is_active' => $isActive,
        ];

        if ($request->hasFile('image')) {
            if ($strukturOrganisasi->image_path && Storage::disk('public')->exists($strukturOrganisasi->image_path)) {
                Storage::disk('public')->delete($strukturOrganisasi->image_path);
            }

            $data['image_path'] = $request->file('image')->storeAs(
                'struktur-organisasi',
                $this->makeFileName($request->file('image')->getClientOriginalExtension()),
                'public'
            );
        }

        $strukturOrganisasi->update($data);

        return redirect()
            ->to('/admin/struktur-organisasis')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    private function makeFileName(string $extension): string
    {
        return 'struktur-organisasi-' . now()->format('YmdHis') . '-' . Str::random(8) . '.' . strtolower($extension);
    }
}
