<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SliderUploadController extends Controller
{
    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'duration_ms' => ['nullable', 'integer', 'min:1000', 'max:30000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $path = $request->file('image')->storeAs(
            'sliders',
            $this->makeFileName($request->file('image')->getClientOriginalExtension()),
            'public'
        );

        Slider::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'image_path' => $path,
            'sort_order' => $validated['sort_order'] ?? 0,
            'duration_ms' => $validated['duration_ms'] ?? 3000,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->to('/admin/sliders')
            ->with('success', 'Slider has been created.');
    }

    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'duration_ms' => ['nullable', 'integer', 'min:1000', 'max:30000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'duration_ms' => $validated['duration_ms'] ?? 3000,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
                Storage::disk('public')->delete($slider->image_path);
            }

            $data['image_path'] = $request->file('image')->storeAs(
                'sliders',
                $this->makeFileName($request->file('image')->getClientOriginalExtension()),
                'public'
            );
        }

        $slider->update($data);

        return redirect()
            ->to('/admin/sliders')
            ->with('success', 'Slider has been updated.');
    }

    private function makeFileName(string $extension): string
    {
        return 'slider-' . now()->format('YmdHis') . '-' . Str::random(8) . '.' . strtolower($extension);
    }
}
