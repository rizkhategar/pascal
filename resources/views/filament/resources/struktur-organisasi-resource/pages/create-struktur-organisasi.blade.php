<x-filament-panels::page>
    <form action="{{ route('admin.struktur-organisasi-upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if ($errors->any())
            <div class="rounded-xl border border-danger-500/50 bg-danger-500/10 p-4 text-sm text-danger-200">
                <strong>Data belum valid.</strong>
                <ul class="mt-2 list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6 shadow-sm">
            <div class="grid gap-6">
                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-white">Judul</label>
                    <input type="text" id="title" name="title" value="{{ old('title', 'Struktur Organisasi') }}" required class="block w-full rounded-lg border border-white/10 bg-white/[0.04] px-3 py-2 text-white outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500">
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-medium text-white">Gambar Struktur Organisasi</label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" required class="block w-full rounded-lg border border-white/10 bg-white/[0.04] px-3 py-2 text-white file:me-4 file:rounded-md file:border-0 file:bg-primary-500 file:px-3 file:py-2 file:font-semibold file:text-gray-950">
                    <p class="mt-2 text-sm text-gray-400">Gunakan file JPG, PNG, atau WEBP. Maksimal 5 MB.</p>
                </div>

                <label class="flex items-center gap-3 text-sm font-medium text-white">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded border-white/10 bg-white/[0.04] text-primary-500 focus:ring-primary-500">
                    Aktif
                </label>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-semibold text-gray-950 hover:bg-primary-400">Simpan Struktur Organisasi</button>
            <a href="{{ \App\Filament\Resources\StrukturOrganisasiResource::getUrl('index') }}" class="rounded-lg border border-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/5">Batal</a>
        </div>
    </form>
</x-filament-panels::page>
