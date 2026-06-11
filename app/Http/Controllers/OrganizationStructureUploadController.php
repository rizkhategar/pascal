<?php

namespace App\Http\Controllers;

use App\Models\OrganizationStructure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrganizationStructureUploadController extends Controller
{
    public function create(): View
    {
        return view('admin.organization-structures.create');
    }

    public function edit(OrganizationStructure $organizationStructure): View
    {
        return view('admin.organization-structures.edit', compact('organizationStructure'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $path = $request->file('image')->storeAs(
            'organization-structures',
            $this->makeFileName($request->file('image')->getClientOriginalExtension()),
            'public'
        );

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            OrganizationStructure::query()->update(['is_active' => false]);
        }

        OrganizationStructure::create([
            'title' => $validated['title'],
            'image_path' => $path,
            'is_active' => $isActive,
        ]);

        return redirect()
            ->to('/admin/organization-structures')
            ->with('success', 'Organization structure has been created.');
    }

    public function update(Request $request, OrganizationStructure $organizationStructure): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isActive = $request->boolean('is_active');

        if ($isActive) {
            OrganizationStructure::query()
                ->whereKeyNot($organizationStructure->getKey())
                ->update(['is_active' => false]);
        }

        $data = [
            'title' => $validated['title'],
            'is_active' => $isActive,
        ];

        if ($request->hasFile('image')) {
            if ($organizationStructure->image_path && Storage::disk('public')->exists($organizationStructure->image_path)) {
                Storage::disk('public')->delete($organizationStructure->image_path);
            }

            $data['image_path'] = $request->file('image')->storeAs(
                'organization-structures',
                $this->makeFileName($request->file('image')->getClientOriginalExtension()),
                'public'
            );
        }

        $organizationStructure->update($data);

        return redirect()
            ->to('/admin/organization-structures')
            ->with('success', 'Organization structure has been updated.');
    }

    private function makeFileName(string $extension): string
    {
        return 'organization-structure-' . now()->format('YmdHis') . '-' . Str::random(8) . '.' . strtolower($extension);
    }
}
