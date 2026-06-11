<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - Pascasarjana UNW</title>

    <style>
        :root {
            --primary: #072b57;
            --yellow: #f7b500;
            --white: #ffffff;
            --light: #f8fafc;
            --text: #111827;
            --muted: #64748b;
            --border: #e5e7eb;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background: var(--light);
        }

        .page-hero {
            background: linear-gradient(135deg, rgba(7, 43, 87, 0.96), rgba(5, 32, 68, 0.94));
            color: var(--white);
            padding: 72px 0;
        }

        .container {
            width: min(100% - 32px, 1120px);
            margin: 0 auto;
        }

        .breadcrumb-text {
            color: var(--yellow);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .page-title {
            font-size: clamp(32px, 5vw, 52px);
            line-height: 1.12;
            margin: 0 0 16px;
            font-weight: 800;
        }

        .page-desc {
            max-width: 720px;
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
            font-size: 17px;
            line-height: 1.7;
        }

        .content-section { padding: 64px 0 80px; }

        .image-card,
        .empty-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .image-card-header,
        .empty-card { padding: 28px; }

        .image-card-header h2,
        .empty-card h2 {
            margin: 0 0 8px;
            color: var(--primary);
            font-size: 26px;
            font-weight: 800;
        }

        .image-card-header p,
        .empty-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .structure-image-wrapper { padding: 0 28px 28px; }

        .structure-image {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: #fff;
        }

        .empty-card { text-align: center; }

        @media (max-width: 768px) {
            .page-hero { padding: 54px 0; }
            .content-section { padding: 44px 0 60px; }

            .image-card-header,
            .empty-card,
            .structure-image-wrapper {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
</head>
<body>
    @include('component.header')

    @php($currentOrganizationStructure = $organizationStructure ?? $strukturOrganisasi ?? null)

    <main>
        <section class="page-hero">
            <div class="container">
                <div class="breadcrumb-text">Profil Pascasarjana</div>
                <h1 class="page-title">Struktur Organisasi</h1>
                <p class="page-desc">
                    Informasi struktur organisasi Pascasarjana Universitas Ngudi Waluyo yang dikelola secara dinamis melalui panel admin.
                </p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                @if ($currentOrganizationStructure && $currentOrganizationStructure->image_path)
                    <article class="image-card">
                        <div class="image-card-header">
                            <h2>{{ $currentOrganizationStructure->title }}</h2>
                            <p>Gambar struktur organisasi terbaru yang aktif ditampilkan pada halaman ini.</p>
                        </div>

                        <div class="structure-image-wrapper">
                            <img
                                src="{{ route('organization-structures.image', $currentOrganizationStructure) }}?v={{ optional($currentOrganizationStructure->updated_at)->timestamp }}"
                                alt="{{ $currentOrganizationStructure->title }}"
                                class="structure-image"
                            >
                        </div>
                    </article>
                @else
                    <div class="empty-card">
                        <h2>Struktur Organisasi Belum Tersedia</h2>
                        <p>Silakan unggah gambar struktur organisasi melalui panel admin Filament terlebih dahulu.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('component.footer')
</body>
</html>
