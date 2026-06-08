<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <style>
        :root {
            --bg: #09090b;
            --sidebar: #0f0f12;
            --topbar: #151518;
            --card: #111113;
            --border: #2a2a2e;
            --text: #f4f4f5;
            --muted: #a1a1aa;
            --primary: #f59e0b;
            --primary-dark: #b45309;
            --active: #1f1f23;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
            background: var(--bg);
        }

        .admin-sidebar {
            width: 280px;
            min-height: 100vh;
            background: var(--sidebar);
            border-right: 1px solid #1f1f23;
            padding: 22px 18px;
            position: sticky;
            top: 0;
            align-self: flex-start;
        }

        .admin-brand {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 28px;
            color: var(--text);
        }

        .admin-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .admin-nav-group {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
            margin: 22px 8px 8px;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d4d4d8;
            text-decoration: none;
            padding: 12px 12px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
        }

        .admin-nav-link:hover,
        .admin-nav-link.active {
            color: var(--primary);
            background: var(--active);
        }

        .admin-nav-icon {
            width: 22px;
            color: var(--primary);
            text-align: center;
        }

        .admin-main {
            flex: 1;
            min-width: 0;
        }

        .admin-topbar {
            height: 72px;
            background: var(--topbar);
            border-bottom: 1px solid #202024;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .admin-topbar-title {
            font-weight: 800;
            color: var(--text);
        }

        .admin-content {
            width: min(100%, 980px);
            padding: 38px 32px 56px;
        }

        .topbar-page {
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

        .back-link,
        .cancel {
            color: var(--text);
            text-decoration: none;
            border: 1px solid var(--border);
            padding: 10px 14px;
            border-radius: 10px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 28px;
        }

        .field { margin-bottom: 22px; }

        label {
            display: block;
            font-weight: 800;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            border: 1px solid var(--border);
            background: #18181b;
            color: var(--text);
            border-radius: 12px;
            padding: 13px 14px;
            font-size: 15px;
        }

        input[type="file"] { cursor: pointer; }

        .help {
            margin-top: 8px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .current-image {
            width: 100%;
            max-height: 360px;
            object-fit: contain;
            display: block;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #fff;
            margin-top: 10px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .checkbox-row label { margin: 0; }

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

        button:hover {
            background: var(--primary-dark);
            color: #fff;
        }

        .error-box {
            background: #7f1d1d;
            border: 1px solid #ef4444;
            color: #fff;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 22px;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        @media (max-width: 980px) {
            .admin-shell { flex-direction: column; }
            .admin-sidebar {
                width: 100%;
                min-height: auto;
                position: static;
            }
            .admin-content { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        @include('admin.partials.custom-filament-sidebar', ['activeMenu' => $activeMenu ?? null])

        <main class="admin-main">
            <div class="admin-topbar">
                <div class="admin-topbar-title">@yield('topbar_title', 'Pascasarjana UNW')</div>
            </div>

            <section class="admin-content">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
