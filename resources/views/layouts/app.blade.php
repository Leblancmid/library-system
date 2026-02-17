<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Library System')</title>

    {{-- Simple inline styling to keep it beginner-friendly --}}
    <style>
        body {
            font-family: system-ui, Arial;
            margin: 0;
            background: #f6f7fb;
            color: #111;
        }

        .topbar {
            background: #111;
            color: #fff;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            font-weight: 700;
            letter-spacing: .2px;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 14px;
            opacity: .9;
        }

        .nav a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .container {
            max-width: 980px;
            margin: 22px auto;
            padding: 0 16px;
        }

        .card {
            background: #fff;
            border: 1px solid #e6e8f0;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        h1 {
            margin: 0 0 10px;
            font-size: 22px;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #edf0f7;
            text-align: left;
            font-size: 14px;
        }

        th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #444;
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .btn.primary {
            background: #111;
            border-color: #111;
            color: #fff;
        }

        .btn.danger {
            background: #fff;
            border-color: #ef4444;
            color: #ef4444;
        }

        .btn:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

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
            margin-bottom: 12px;
        }

        input,
        select {
            padding: 10px 10px;
            border-radius: 10px;
            border: 1px solid #dfe3ef;
            font-size: 14px;
            background: #fff;
        }

        .muted {
            color: #666;
            font-size: 13px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 12px;
            border: 1px solid #dfe3ef;
            background: #f8fafc;
        }

        .flash {
            padding: 10px 12px;
            border-radius: 12px;
            margin-bottom: 14px;
            border: 1px solid #dfe3ef;
            background: #f8fafc;
        }

        .errors {
            padding: 10px 12px;
            border-radius: 12px;
            margin-bottom: 14px;
            border: 1px solid #fecaca;
            background: #fff1f2;
            color: #991b1b;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="brand">📚 Library System</div>
        <div class="nav">
            <a href="{{ route('books.index') }}">Books</a>
            <a href="{{ route('members.index') }}">Members</a>
            <a href="{{ route('loans.index') }}">Loans</a>
        </div>
    </div>

    <div class="container">
        @include('partials.flash')
        @yield('content')
    </div>
</body>

</html>