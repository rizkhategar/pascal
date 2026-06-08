@extends('admin.layouts.custom-filament')

@section('title', 'Edit Struktur Organisasi')
@section('topbar_title', 'Struktur Organisasi')

@php($activeMenu = 'struktur-organisasi')

@section('content')
    <div class="topbar-page">
        <h1>Edit Struktur Organisasi</h1>
        <a class="back-link" href="/admin/struktur-organisasis">Kembali</a>
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

        <form action="{{ route('admin.struktur-organisasi-upload.update', $strukturOrganisasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="title">Judul</label>
                <input type="text" id="title" name="title" value="{{ old('title', $strukturOrganisasi->title) }}" required>
            </div>

            <div class="field">
                <label>Gambar Saat Ini</label>
                @if ($strukturOrganisasi->image_path)
                    <img src="{{ asset('storage/' . $strukturOrganisasi->image_path) }}" alt="{{ $strukturOrganisasi->title }}" class="current-image">
                @else
                    <div class="help">Belum ada gambar.</div>
                @endif
            </div>

            <div class="field">
                <label for="image">Ganti Gambar Struktur Organisasi</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                <div class="help">Kosongkan jika tidak ingin mengganti gambar. File JPG, PNG, atau WEBP. Maksimal 5 MB.</div>
            </div>

            <div class="checkbox-row">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $strukturOrganisasi->is_active) ? 'checked' : '' }}>
                <label for="is_active">Aktif</label>
            </div>

            <div class="actions">
                <button type="submit">Simpan Perubahan</button>
                <a class="cancel" href="/admin/struktur-organisasis">Batal</a>
            </div>
        </form>
    </div>
@endsection
