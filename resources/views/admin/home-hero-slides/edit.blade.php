<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hero Campus</title>
    <style>
        :root { --bg:#09090b; --card:#111113; --border:#2a2a2e; --text:#f4f4f5; --muted:#a1a1aa; --primary:#f59e0b; --primary-dark:#b45309; }
        *{box-sizing:border-box} body{margin:0;min-height:100vh;font-family:Arial,Helvetica,sans-serif;background:var(--bg);color:var(--text);padding:48px 20px}.container{width:min(100%,860px);margin:0 auto}.topbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:28px}h1{margin:0;font-size:30px;line-height:1.2}.back-link,.cancel{color:var(--text);text-decoration:none;border:1px solid var(--border);padding:10px 14px;border-radius:10px;font-weight:700}.card{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:28px}.field{margin-bottom:22px}label{display:block;font-weight:800;margin-bottom:8px}input[type="text"],input[type="number"],input[type="file"]{width:100%;border:1px solid var(--border);background:#18181b;color:var(--text);border-radius:12px;padding:13px 14px;font-size:15px}.help{margin-top:8px;color:var(--muted);font-size:14px;line-height:1.5}.current-image{width:100%;max-height:360px;object-fit:cover;display:block;border:1px solid var(--border);border-radius:14px;background:#fff;margin-top:10px}.checkbox-row{display:flex;align-items:center;gap:10px;margin-bottom:24px}.checkbox-row label{margin:0}.actions{display:flex;gap:12px;flex-wrap:wrap}button{border:none;background:var(--primary);color:#111827;padding:12px 18px;border-radius:10px;font-weight:900;cursor:pointer}button:hover{background:var(--primary-dark);color:#fff}.cancel{display:inline-flex;align-items:center;padding:12px 18px;font-weight:800}.error-box{background:#7f1d1d;border:1px solid #ef4444;color:#fff;border-radius:12px;padding:14px 18px;margin-bottom:22px}.error-box ul{margin:8px 0 0;padding-left:20px}
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
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
                        <img src="{{ asset('storage/' . $homeHeroSlide->image_path) }}" alt="{{ $homeHeroSlide->title }}" class="current-image">
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
    </div>
</body>
</html>
