<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Library') — Biblion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ── Tokens ── */
        :root {
            --bg: #f5f1ea;
            --surface: #fdfcf8;
            --surface-2: #f0ece3;
            --border: #e3ddd3;
            --border-2: #cdc6b8;
            --ink: #1c1916;
            --ink-2: #5a5349;
            --ink-3: #9c9487;
            --accent: #b83228;
            --accent-2: #e9d9b8;
            --accent-3: #f5eed8;
            --sidebar-w: 220px;
            --radius: 14px;
            --radius-sm: 10px;
        }

        [data-theme="dark"] {
            --bg: #131109;
            --surface: #1b1914;
            --surface-2: #231f18;
            --border: #2c2921;
            --border-2: #3d3830;
            --ink: #ede9e0;
            --ink-2: #afa89c;
            --ink-3: #6b6459;
            --accent: #e05a4a;
            --accent-2: #3b2d18;
            --accent-3: #2a2010;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            transition: background .25s, color .25s;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 50;
            transition: background .25s, border-color .25s;
        }

        /* Top accent bar */
        .sidebar::before {
            content: '';
            display: block;
            height: 3px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-2) 70%, transparent 100%);
            flex-shrink: 0;
        }

        .sidebar-brand {
            padding: 20px 18px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            background: var(--ink);
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 17px;
            flex-shrink: 0;
            transition: background .25s;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -.3px;
            color: var(--ink);
            line-height: 1;
        }

        .brand-tagline {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--ink-3);
            font-weight: 500;
        }

        /* Nav sections */
        .sidebar-section {
            padding: 16px 12px 8px;
        }

        .sidebar-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--ink-3);
            padding: 0 6px;
            margin-bottom: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: var(--radius-sm);
            color: var(--ink-2);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background .15s, color .15s;
            margin-bottom: 2px;
            letter-spacing: .1px;
        }

        .nav-item:hover {
            background: var(--accent-3);
            color: var(--ink);
        }

        .nav-item.active {
            background: var(--accent-2);
            color: var(--ink);
            font-weight: 600;
        }

        .nav-icon {
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Sidebar footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 14px 12px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .sidebar-footer-label {
            font-size: 12px;
            color: var(--ink-3);
        }

        .theme-btn {
            width: 34px;
            height: 34px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: var(--surface-2);
            cursor: pointer;
            font-size: 15px;
            display: grid;
            place-items: center;
            transition: background .15s, border-color .15s;
            flex-shrink: 0;
        }

        .theme-btn:hover {
            background: var(--accent-2);
            border-color: var(--border-2);
        }

        /* ── Main area ── */
        .main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* Topbar — now just a thin page-context bar */
        .topbar {
            height: 52px;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            z-index: 40;
            transition: background .25s, border-color .25s;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--ink-3);
        }

        .topbar-breadcrumb strong {
            color: var(--ink);
            font-weight: 600;
        }

        .topbar-breadcrumb .sep {
            opacity: .5;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-date {
            font-size: 12px;
            color: var(--ink-3);
            letter-spacing: .2px;
        }

        /* ── Content ── */
        .content {
            padding: 28px 32px;
            flex: 1;
            animation: fadeUp .3s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Flash messages ── */
        .flash {
            padding: 12px 16px;
            border-radius: var(--radius);
            margin-bottom: 18px;
            border: 1px solid var(--border);
            background: var(--accent-3);
            font-size: 14px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .errors {
            padding: 12px 16px;
            border-radius: var(--radius);
            margin-bottom: 18px;
            border: 1px solid #fecaca;
            background: #fff1f2;
            color: #991b1b;
            font-size: 14px;
        }

        [data-theme="dark"] .errors {
            background: #2d0a0a;
            border-color: #7f1d1d;
            color: #fca5a5;
        }

        /* ── Mobile ── */
        .mobile-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 8px 16px;
            z-index: 200;
            gap: 0;
        }

        .mobile-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: 6px 4px;
            border-radius: var(--radius-sm);
            color: var(--ink-3);
            text-decoration: none;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            transition: color .15s, background .15s;
        }

        .mobile-nav-item .icon {
            font-size: 18px;
        }

        .mobile-nav-item.active,
        .mobile-nav-item:hover {
            color: var(--ink);
            background: var(--accent-3);
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .mobile-bar {
                display: flex;
            }

            .topbar {
                padding: 0 16px;
            }

            .content {
                padding: 20px 16px 80px;
            }
        }
    </style>
</head>

<body>

    {{-- ── Sidebar ── --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-mark">📚</div>
            <div class="brand-text">
                <span class="brand-name">Biblion</span>
                <span class="brand-tagline">Library System</span>
            </div>
        </div>

        <div class="sidebar-section">
            <p class="sidebar-section-label">Catalog</p>

            <a href="{{ route('books.index') }}" class="nav-item {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <span class="nav-icon">📖</span>
                Books
            </a>

            <a href="{{ route('members.index') }}"
                class="nav-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <span class="nav-icon">👤</span>
                Members
            </a>

            <a href="{{ route('loans.index') }}" class="nav-item {{ request()->routeIs('loans.*') ? 'active' : '' }}">
                <span class="nav-icon">🔖</span>
                Loans
            </a>
        </div>

        <div class="sidebar-footer">
            <span class="sidebar-footer-label">Toggle theme</span>
            <button class="theme-btn" id="theme-toggle" title="Toggle theme">🌙</button>
        </div>
    </aside>

    {{-- ── Main ── --}}
    <div class="main">

        {{-- Thin context topbar --}}
        <div class="topbar">
            <div class="topbar-breadcrumb">
                <span>Biblion</span>
                <span class="sep">›</span>
                <strong>@yield('title', 'Dashboard')</strong>
            </div>
            <div class="topbar-right">
                <span class="topbar-date" id="live-date"></span>
            </div>
        </div>

        <div class="content">
            @include('partials.flash')
            @yield('content')
        </div>
    </div>

    {{-- ── Mobile bottom nav ── --}}
    <nav class="mobile-bar">
        <a href="{{ route('books.index') }}"
            class="mobile-nav-item {{ request()->routeIs('books.*') ? 'active' : '' }}">
            <span class="icon">📖</span> Books
        </a>
        <a href="{{ route('members.index') }}"
            class="mobile-nav-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
            <span class="icon">👤</span> Members
        </a>
        <a href="{{ route('loans.index') }}"
            class="mobile-nav-item {{ request()->routeIs('loans.*') ? 'active' : '' }}">
            <span class="icon">🔖</span> Loans
        </a>
        <button class="mobile-nav-item" id="theme-toggle-mobile"
            style="border:none;cursor:pointer;background:none;font-family:inherit;">
            <span class="icon" id="mobile-theme-icon">🌙</span> Theme
        </button>
    </nav>

    <script>
        // ── Theme ──
        const root = document.documentElement;
        const toggle = document.getElementById('theme-toggle');
        const mToggle = document.getElementById('theme-toggle-mobile');
        const mIcon = document.getElementById('mobile-theme-icon');

        const saved = localStorage.getItem('theme') || 'light';
        applyTheme(saved);

        function applyTheme(t) {
            root.setAttribute('data-theme', t);
            localStorage.setItem('theme', t);
            const icon = t === 'dark' ? '☀️' : '🌙';
            if (toggle) toggle.textContent = icon;
            if (mIcon) mIcon.textContent = icon;
        }

        toggle?.addEventListener('click', () => applyTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'));
        mToggle?.addEventListener('click', () => applyTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'));

        // ── Live date ──
        const dateEl = document.getElementById('live-date');
        function updateDate() {
            if (!dateEl) return;
            dateEl.textContent = new Date().toLocaleDateString('en-US', {
                weekday: 'short', month: 'short', day: 'numeric', year: 'numeric'
            });
        }
        updateDate();
    </script>

</body>

</html>