<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Pascasarjana UNW</title>
    <link rel="icon" href="{{ asset('logo_unwnobg.png') }}" type="image/png">
    <style>
        :root {
            color-scheme: dark;
            --fi-bg: #09090b;
            --fi-sidebar: #0b0b0f;
            --fi-topbar: #151519;
            --fi-card: #101014;
            --fi-border: rgba(255, 255, 255, 0.10);
            --fi-border-soft: rgba(255, 255, 255, 0.07);
            --fi-text: #fafafa;
            --fi-muted: #a1a1aa;
            --fi-soft: #d4d4d8;
            --fi-active: rgba(245, 158, 11, 0.13);
            --fi-hover: rgba(255, 255, 255, 0.055);
            --fi-primary: #f59e0b;
            --fi-primary-dark: #b45309;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--fi-bg);
            color: var(--fi-text);
            font-size: 15px;
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
            background: var(--fi-bg);
        }

        .admin-sidebar {
            width: 320px;
            min-height: 100vh;
            background: var(--fi-sidebar);
            border-right: 1px solid var(--fi-border-soft);
            padding: 22px 18px 28px;
            position: sticky;
            top: 0;
            align-self: flex-start;
            overflow-y: auto;
        }

        .admin-brand {
            height: 56px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--fi-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 22px;
        }

        .admin-brand-logo {
            width: 34px;
            height: 34px;
            object-fit: contain;
            flex: 0 0 auto;
        }

        .admin-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .admin-nav-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--fi-muted);
            font-size: 13px;
            font-weight: 600;
            padding: 22px 10px 7px;
        }

        .admin-nav-group::after {
            content: "⌃";
            color: #71717a;
            font-size: 14px;
            transform: translateY(1px);
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 42px;
            color: #d4d4d8;
            text-decoration: none;
            padding: 9px 11px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 650;
            line-height: 1.25;
            transition: background 0.16s ease, color 0.16s ease;
        }

        .admin-nav-link:hover {
            background: var(--fi-hover);
            color: var(--fi-text);
        }

        .admin-nav-link.active {
            background: var(--fi-active);
            color: var(--fi-primary);
        }

        .admin-nav-icon {
            width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #a1a1aa;
            flex: 0 0 auto;
        }

        .admin-nav-link.active .admin-nav-icon {
            color: var(--fi-primary);
        }

        .admin-nav-icon svg {
            width: 21px;
            height: 21px;
            stroke-width: 1.8;
        }

        .admin-main {
            flex: 1;
            min-width: 0;
        }

        .admin-topbar {
            height: 73px;
            background: var(--fi-topbar);
            border-bottom: 1px solid var(--fi-border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            gap: 24px;
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .admin-topbar-title {
            color: var(--fi-soft);
            font-weight: 650;
            min-width: 160px;
        }

        .admin-topbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .admin-search {
            width: min(340px, 34vw);
            height: 42px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.035);
            border-radius: 9px;
            color: #71717a;
            padding: 0 14px;
        }

        .admin-search svg {
            width: 19px;
            height: 19px;
        }

        .admin-search span {
            color: #71717a;
            font-size: 15px;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: #050507;
            color: #f4f4f5;
            font-size: 13px;
            font-weight: 700;
        }

        .admin-content {
            width: min(100%, 1040px);
            padding: 38px 32px 56px;
        }

        .topbar-page {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 26px;
        }

        h1 {
            margin: 0;
            font-size: 31px;
            line-height: 1.18;
            letter-spacing: -0.035em;
            color: var(--fi-text);
            font-weight: 800;
        }

        .back-link,
        .cancel {
            color: var(--fi-text);
            text-decoration: none;
            border: 1px solid var(--fi-border);
            background: rgba(255, 255, 255, 0.025);
            padding: 10px 14px;
            border-radius: 9px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
        }

        .back-link:hover,
        .cancel:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .card {
            background: var(--fi-card);
            border: 1px solid var(--fi-border-soft);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.03) inset;
        }

        .field { margin-bottom: 22px; }

        label {
            display: block;
            color: #f4f4f5;
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.13);
            background: #111114;
            color: var(--fi-text);
            border-radius: 10px;
            padding: 12px 13px;
            font-size: 15px;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="file"]:focus {
            border-color: var(--fi-primary);
            box-shadow: 0 0 0 1px var(--fi-primary);
        }

        input[type="file"] { cursor: pointer; }

        .help {
            margin-top: 8px;
            color: var(--fi-muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .current-image {
            width: 100%;
            max-height: 360px;
            object-fit: contain;
            display: block;
            border: 1px solid var(--fi-border);
            border-radius: 12px;
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

        input[type="checkbox"] {
            accent-color: var(--fi-primary);
            width: 18px;
            height: 18px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 2px;
        }

        button {
            border: none;
            background: var(--fi-primary);
            color: #111827;
            padding: 11px 17px;
            border-radius: 9px;
            font-weight: 800;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: var(--fi-primary-dark);
            color: #fff;
        }

        .error-box {
            background: rgba(127, 29, 29, 0.55);
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
            .admin-topbar { padding: 0 18px; }
            .admin-search { display: none; }
            .admin-content { width: 100%; padding: 28px 18px 46px; }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        @include('admin.partials.custom-filament-sidebar', ['activeMenu' => $activeMenu ?? null])

        <main class="admin-main">
            <div class="admin-topbar">
                <div class="admin-topbar-title">@yield('topbar_title', 'Pascasarjana UNW')</div>

                <div class="admin-topbar-actions">
                    <div class="admin-search">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m1.1-5.15a6.25 6.25 0 1 1-12.5 0 6.25 6.25 0 0 1 12.5 0Z" />
                        </svg>
                        <span>Search</span>
                    </div>
                    <div class="admin-avatar">AB</div>
                </div>
            </div>

            <section class="admin-content">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
