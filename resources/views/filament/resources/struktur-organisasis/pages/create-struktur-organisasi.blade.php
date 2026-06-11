<x-filament-panels::page>
    <style>
        .custom-filament-form { width: min(100%, 920px); display: grid; gap: 24px; }
        .custom-form-card { border: 1px solid rgba(255,255,255,.10); background: rgba(255,255,255,.035); border-radius: 16px; padding: 24px; }
        .custom-form-grid { display: grid; gap: 22px; }
        .custom-field label, .custom-checkbox span { display: block; margin-bottom: 8px; color: #f4f4f5; font-size: 14px; font-weight: 700; }
        .custom-field input[type="text"], .custom-field input[type="number"], .custom-field input[type="file"] { display: block; width: 100%; min-height: 42px; border: 1px solid rgba(255,255,255,.14); background: #111114; color: #f4f4f5; border-radius: 10px; padding: 10px 12px; outline: none; }
        .custom-field input:focus { border-color: #f59e0b; box-shadow: 0 0 0 1px #f59e0b; }
        .custom-field input[type="file"]::file-selector-button { border: 0; border-radius: 8px; background: #f59e0b; color: #111827; font-weight: 800; padding: 8px 12px; margin-right: 14px; cursor: pointer; }
        .custom-help { margin-top: 8px; color: #a1a1aa; font-size: 14px; line-height: 1.5; }
        .custom-checkbox { display: flex; align-items: center; gap: 10px; color: #f4f4f5; font-size: 14px; font-weight: 700; }
        .custom-checkbox span { margin-bottom: 0; }
        .custom-checkbox input { width: 18px; height: 18px; accent-color: #f59e0b; }
        .custom-actions { display: flex; flex-wrap: wrap; gap: 12px; }
        .custom-btn-primary, .custom-btn-secondary { display: inline-flex; align-items: center; justify-content: center; min-height: 40px; padding: 9px 16px; border-radius: 9px; font-size: 14px; font-weight: 800; text-decoration: none; cursor: pointer; }
        .custom-btn-primary { border: 0; background: #f59e0b; color: #111827; }
        .custom-btn-primary:hover { background: #fbbf24; }
        .custom-btn-secondary { border: 1px solid rgba(255,255,255,.14); background: transparent; color: #f4f4f5; }
        .custom-btn-secondary:hover { background: rgba(255,255,255,.06); }
        .custom-error { border: 1px solid rgba(239,68,68,.65); background: rgba(127,29,29,.25); color: #fecaca; border-radius: 14px; padding: 14px 18px; font-size: 14px; }
        .custom-error ul { margin: 8px 0 0; padding-left: 20px; }
    </style>

    <form action="{{ route('admin.struktur-organisasi-upload.store') }}" method="POST" enctype="multipart/form-data" class="custom-filament-form">
        @csrf

        @if ($errors->any())
            <div class="custom-error">
                <strong>Data belum valid.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="custom-form-card">
            <div class="custom-form-grid">
                <div class="custom-field">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" value="{{ old('title', 'Struktur Organisasi') }}" required>
                </div>

                <div class="custom-field">
                    <label for="image">Gambar Struktur Organisasi</label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" required>
                    <p class="custom-help">Gunakan file JPG, PNG, atau WEBP. Maksimal 5 MB.</p>
                </div>

                <label class="custom-checkbox">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <span>Aktif</span>
                </label>
            </div>
        </div>

        <div class="custom-actions">
            <button type="submit" class="custom-btn-primary">Simpan Struktur Organisasi</button>
            <a href="{{ \App\Filament\Resources\StrukturOrganisasis\StrukturOrganisasiResource::getUrl('index') }}" class="custom-btn-secondary">Batal</a>
        </div>
    </form>
</x-filament-panels::page>
