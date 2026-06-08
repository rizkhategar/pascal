@extends('admin.layouts.custom-filament')

@section('title', 'Tambah Struktur Organisasi')
@section('topbar_title', 'Struktur Organisasi')

@php($activeMenu = 'struktur-organisasi')

@section('content')
    <div class="topbar-page">
        <h1>Tambah Struktur Organisasi</h1>
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

        <form action="{{ route('admin.struktur-organisasi-upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label for="title">Judul</label>
                <input type="text" id="title" name="title" value="{{ old('title', 'Struktur Organisasi') }}" required>
            </div>

            <div class="field">
                <label for="image">Gambar Struktur Organisasi</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" required>
                <div class="help">Gunakan file JPG, PNG, atau WEBP. Maksimal 5 MB. Upload diproses langsung saat tombol simpan ditekan, bukan memakai FilePond.</div>
            </div>

            <div class="checkbox-row">
                <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                <label for="is_active">Aktif</label>
            </div>

            <div class="actions">
                <button type="submit">Simpan Struktur Organisasi</button>
                <a class="cancel" href="/admin/struktur-organisasis">Batal</a>
            </div>
        </form>
    </div>
@endsection
