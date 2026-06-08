@extends('admin.layouts.custom-filament')

@section('title', 'Edit Hero Campus')
@section('topbar_title', 'Hero Campus')

@php($activeMenu = 'hero-campus')

@section('content')
    <div class="topbar-page">
        <h1>Edit Hero Campus</h1>
        <a class="back-link" href="/admin/home-hero-slides">Kembali</a>
    </div>

    <div class="card">
        @if ($errors->any())
            <div class="error-box">
                <strong>Data belum valid.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.home-hero-slides.update-custom', $homeHeroSlide) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="title">Teks Judul Hero</label>
                <input type="text" id="title" name="title" value="{{ old('title', $homeHeroSlide->title) }}" required>
                <div class="help">Teks ini akan tampil pada hero. Tombol Daftar Sekarang tetap statis.</div>
            </div>

            <div class="field">
                <label for="subtitle">Teks Subtitle Hero</label>
                <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $homeHeroSlide->subtitle) }}" required>
            </div>

            <div class="field">
                <label>Gambar Saat Ini</label>
                @if ($homeHeroSlide->image_path)
                    <img src="{{ route('hero-campus.image', $homeHeroSlide) }}" alt="{{ $homeHeroSlide->title }}" class="current-image">
                @else
                    <div class="help">Belum ada gambar.</div>
                @endif
            </div>

            <div class="field">
                <label for="image">Ganti Gambar Hero Campus</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                <div class="help">Kosongkan jika tidak ingin mengganti gambar. File JPG, PNG, atau WEBP. Maksimal 8 MB.</div>
            </div>

            <div class="field">
                <label for="sort_order">Urutan Slide</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $homeHeroSlide->sort_order) }}" min="0">
            </div>

            <div class="field">
                <label for="duration_ms">Durasi Ganti Gambar (milidetik)</label>
                <input type="number" id="duration_ms" name="duration_ms" value="{{ old('duration_ms', $homeHeroSlide->duration_ms ?? 3000) }}" min="1000" max="30000" step="100">
                <div class="help">Contoh: 3000 berarti gambar berganti setiap 3 detik. Minimal 1000, maksimal 30000.</div>
            </div>

            <div class="checkbox-row">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $homeHeroSlide->is_active) ? 'checked' : '' }}>
                <label for="is_active">Aktif</label>
            </div>

            <div class="actions">
                <button type="submit">Simpan Perubahan</button>
                <a class="cancel" href="/admin/home-hero-slides">Batal</a>
            </div>
        </form>
    </div>
@endsection
