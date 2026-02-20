<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Library System')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #f4f1eb;
            --surface: #fffef9;
            --border: #e2ddd4;
            --ink: #1a1714;
            --ink-2: #5c574f;
            --ink-3: #9e9890;
            --accent: #c0392b;
            --accent-2: #e8d5b0;
            --radius: 14px;
            --shadow: 0 2px 12px rgba(26, 23, 20, .07);
        }

        [data-theme="dark"] {
            --bg: #16140f;
            --surface: #1e1c16;
            --border: #2e2b24;
            --ink: #f0ece3;
            --ink-2: #b0a99e;
            --ink-3: #6a6459;
            --accent: #e05a4a;
            --accent-2: #3a2e1a;
            --shadow: 0 2px 12px rgba(0, 0, 0, .3);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            transition: background .3s, color .3s;
        }

        /* ── Top bar ── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 62px;
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow);
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.3px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-icon {
            width: 32px;
            height: 32px;
            background: var(--ink);
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .nav a {
            color: var(--ink-2);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 7px 14px;
            border-radius: 10px;
            transition: background .15s, color .15s;
            letter-spacing: .1px;
        }

        .nav a:hover,
        .nav a.active {
            background: var(--accent-2);
            color: var(--ink);
        }

        /* Theme toggle */
        #theme-toggle {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            cursor: pointer;
            font-size: 16px;
            display: grid;
            place-items: center;
            transition: background .15s, border-color .15s;
            margin-left: 8px;
        }

        #theme-toggle:hover {
            background: var(--accent-2);
            border-color: var(--ink-3);
        }

        /* ── Container ── */
        .container {
            max-width: 1020px;
            margin: 32px auto;
            padding: 0 24px;
        }

        /* ── Cards ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow);
        }

        .card+.card {
            margin-top: 16px;
        }

        /* ── Grid ── */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        @media (max-width: 720px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 0 16px;
            }

            .container {
                margin: 20px auto;
                padding: 0 16px;
            }
        }

        /* ── Typography ── */
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -.4px;
            margin-bottom: 18px;
            color: var(--ink);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 500;
            margin-bottom: 14px;
            color: var(--ink);
        }

        /* ── Tables ── */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            border-bottom: 2px solid var(--border);
        }

        th {
            padding: 10px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--ink-3);
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            color: var(--ink);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--accent-2);
            transition: background .1s;
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--ink);
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: background .15s, border-color .15s, color .15s, box-shadow .15s;
            white-space: nowrap;
        }

        .btn:hover {
            background: var(--accent-2);
            border-color: var(--ink-3);
        }

        .btn.primary {
            background: var(--ink);
            border-color: var(--ink);
            color: var(--bg);
        }

        .btn.primary:hover {
            opacity: .85;
        }

        .btn.danger {
            border-color: #fca5a5;
            color: var(--accent);
        }

        .btn.danger:hover {
            background: #fff1f2;
            border-color: var(--accent);
        }

        .btn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        /* ── Form elements ── */
        .row {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
        }

        .field label {
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--ink-3);
        }

        input,
        select {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            transition: border-color .15s, box-shadow .15s;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: var(--ink-3);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--ink) 8%, transparent);
        }

        /* ── Utility ── */
        .muted {
            color: var(--ink-3);
            font-size: 13px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid var(--border);
            background: var(--accent-2);
            color: var(--ink-2);
        }

        .flash {
            padding: 12px 16px;
            border-radius: var(--radius);
            margin-bottom: 18px;
            border: 1px solid var(--border);
            background: var(--accent-2);
            font-size: 14px;
            color: var(--ink);
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

        /* ── Page enter animation ── */
        .container {
            animation: fadeUp .35s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Decorative top accent line */
        .topbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-2), transparent);
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="brand">
            <div class="brand-icon">📚</div>
            Library
        </div>
        <div class="nav">
            <a href="{{ route('books.index') }}">Books</a>
            <a href="{{ route('members.index') }}">Members</a>
            <a href="{{ route('loans.index') }}">Loans</a>
            <button id="theme-toggle" title="Toggle theme">🌙</button>
        </div>
    </div>

    <div class="container">
        @include('partials.flash')
        @yield('content')
    </div>

    <script>
        const toggle = document.getElementById('theme-toggle');
        const root = document.documentElement;

        // Apply saved theme immediately
        const saved = localStorage.getItem('theme') || 'light';
        root.setAttribute('data-theme', saved);
        toggle.textContent = saved === 'dark' ? '☀️' : '🌙';

        // Highlight active nav link
        document.querySelectorAll('.nav a').forEach(a => {
            if (a.href && window.location.pathname.startsWith(new URL(a.href).pathname)) {
                a.classList.add('active');
            }
        });

        toggle.addEventListener('click', () => {
            const isDark = root.getAttribute('data-theme') === 'dark';
            const next = isDark ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            toggle.textContent = next === 'dark' ? '☀️' : '🌙';
        });
    </script>
</body>

</html>