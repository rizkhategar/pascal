<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Struktur Organisasi</title>
    <style>
        :root {
            --bg: #09090b;
            --card: #111113;
            --border: #2a2a2e;
            --text: #f4f4f5;
            --muted: #a1a1aa;
            --primary: #f59e0b;
            --primary-dark: #b45309;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            padding: 48px 20px;
        }
        .container {
            width: min(100%, 840px);
            margin: 0 auto;
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
        }
        h1 {
            margin: 0;
            font-size: 30px;
            line-height: 1.2;
        }
        .back-link {
            color: var(--text);
            text-decoration: none;
            border: 1px solid var(--border);
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 700;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 28px;
        }
        .field {
            margin-bottom: 22px;
        }
        label {
            display: block;
            font-weight: 800;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            border: 1px solid var(--border);
            background: #18181b;
            color: var(--text);
            border-radius: 12px;
            padding: 13px 14px;
            font-size: 15px;
        }
        input[type="file"] {
            cursor: pointer;
        }
        .help {
            margin-top: 8px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .checkbox-row label {
            margin: 0;
        }
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        button {
            border: none;
            background: var(--primary);
            color: #111827;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: 900;
            cursor: pointer;
        }
        button:hover { background: var(--primary-dark); color: #fff; }
        .cancel {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            border: 1px solid var(--border);
            color: var(--text);
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: 800;
        }
        .error-box {
            background: #7f1d1d;
            border: 1px solid #ef4444;
            color: #fff;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 22px;
        }
        .error-box ul { margin: 8px 0 0; padding-left: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
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
    </div>
</body>
</html>
