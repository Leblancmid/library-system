@extends('layouts.app')

@section('title', 'Loans')

@section('content')

    <style>
        /* ========= Tokens ========= */
        :root {
            --radius: 16px;
            --radius-sm: 12px;
        }

        /* ========= Header ========= */
        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -.6px;
            color: var(--ink);
            margin: 0 0 4px;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--ink-3);
            margin: 0;
        }

        /* ========= Stats ========= */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin: 10px 0 18px;
        }

        @media (max-width: 980px) {
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 520px) {
            .stats { grid-template-columns: 1fr; }
        }

        .stat {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 2px 12px rgba(26, 23, 20, .06);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .stat .k {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--ink-3);
            margin: 0 0 6px;
            font-weight: 600;
        }

        .stat .v {
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
            line-height: 1;
        }

        .stat .chip {
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            color: var(--ink-3);
            background: color-mix(in srgb, var(--accent-2) 35%, transparent);
            white-space: nowrap;
        }

        /* ========= Layout ========= */
        .layout {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 16px;
            align-items: start;
        }

        @media (max-width: 980px) {
            .layout { grid-template-columns: 1fr; }
        }

        /* ========= Panel ========= */
        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 2px 12px rgba(26, 23, 20, .06);
            overflow: hidden;
        }

        .panel-head {
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--ink);
            margin: 0 0 4px;
            letter-spacing: -.3px;
        }

        .panel-subtitle {
            font-size: 13px;
            color: var(--ink-3);
            margin: 0;
        }

        /* ========= Form ========= */
        .form {
            padding: 18px 20px;
        }

        .form-grid {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }

        .field label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--ink-3);
        }

        .req { color: var(--accent); }

        .field input,
        .field select {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid var(--border);
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--ink);
            outline: none;
            transition: border-color .15s, box-shadow .15s, transform .05s;
            width: 100%;
        }

        .field input:focus,
        .field select:focus {
            border-color: var(--ink-3);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--ink) 10%, transparent);
        }

        .field input:active,
        .field select:active {
            transform: translateY(1px);
        }

        .field-hint {
            font-size: 12px;
            color: var(--ink-3);
            margin-top: 2px;
        }

        .error {
            font-size: 12px;
            color: var(--accent);
            margin-top: 2px;
        }

        .actions {
            display: flex;
            gap: 8px;
            margin-top: 6px;
            flex-wrap: wrap;
        }

        /* ========= Buttons ========= */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--ink);
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: background .15s, border-color .15s, opacity .15s, transform .05s;
            white-space: nowrap;
            line-height: 1;
        }

        .btn:hover {
            background: var(--accent-2);
            border-color: var(--ink-3);
        }

        .btn:active { transform: translateY(1px); }

        .btn-primary {
            background: var(--ink);
            border-color: var(--ink);
            color: var(--bg);
        }

        .btn-primary:hover {
            opacity: .88;
            background: var(--ink);
        }

        .btn-ghost {
            background: transparent;
            color: var(--ink-3);
        }

        .btn-ghost:hover {
            background: var(--accent-2);
            color: var(--ink);
        }

        .btn-small {
            padding: 7px 11px;
            font-size: 12px;
            border-radius: 10px;
        }

        .btn-success {
            border-color: #86efac;
            color: #15803d;
            background: transparent;
        }

        .btn-success:hover {
            background: #f0fdf4;
            border-color: #15803d;
        }

        .btn:disabled,
        .btn[disabled] {
            opacity: .4;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ========= Toolbar ========= */
        .toolbar {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg) 70%, transparent);
        }

        .toolbar-grid {
            display: grid;
            grid-template-columns: 1fr 180px 180px auto;
            gap: 10px;
            align-items: end;
        }

        @media (max-width: 980px) {
            .toolbar-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 560px) {
            .toolbar-grid { grid-template-columns: 1fr; }
        }

        .hint {
            font-size: 12px;
            color: var(--ink-3);
            margin: 6px 0 0;
        }

        /* ========= Table ========= */
        .table-wrap { overflow-x: auto; }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        .table thead tr {
            border-bottom: 2px solid var(--border);
        }

        .table th {
            padding: 12px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .9px;
            color: var(--ink-3);
            background: var(--bg);
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            color: var(--ink);
            vertical-align: middle;
            background: transparent;
        }

        .table tbody tr:hover td {
            background: color-mix(in srgb, var(--accent-2) 40%, transparent);
            transition: background .1s;
        }

        .actions-col { text-align: right; }

        .loan-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .loan-cell .title {
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .loan-cell .meta {
            font-size: 12px;
            color: var(--ink-3);
        }

        .date-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .date-cell .date-val {
            font-size: 13px;
            font-weight: 600;
        }

        .date-cell .date-label {
            font-size: 11px;
            color: var(--ink-3);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .row-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
        }

        /* ========= Badges ========= */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            border: 1px solid var(--border);
            white-space: nowrap;
        }

        .badge-returned {
            background: #f0fdf4;
            border-color: #86efac;
            color: #15803d;
        }

        .badge-borrowed {
            background: #eff6ff;
            border-color: #93c5fd;
            color: #1d4ed8;
        }

        .badge-overdue {
            background: #fff1f2;
            border-color: #fca5a5;
            color: var(--accent);
        }

        /* ========= Empty + Pagination ========= */
        .empty {
            text-align: center;
            padding: 36px 20px;
            color: var(--ink-3);
        }

        .empty strong {
            display: block;
            font-size: 15px;
            color: var(--ink-2);
            margin-bottom: 6px;
        }

        .pagination {
            padding: 14px 16px;
            border-top: 1px solid var(--border);
            background: var(--bg);
            font-size: 13px;
        }

        /* ========= Dark mode tweaks ========= */
        [data-theme="dark"] .stat,
        [data-theme="dark"] .panel {
            box-shadow: 0 2px 14px rgba(0, 0, 0, .35);
        }

        [data-theme="dark"] .table th {
            background: var(--surface);
            color: var(--ink-2);
        }

        [data-theme="dark"] .table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.05);
        }

        [data-theme="dark"] .badge-returned {
            background: #052e16;
            border-color: #166534;
            color: #86efac;
        }

        [data-theme="dark"] .badge-borrowed {
            background: #0f1e3a;
            border-color: #1e40af;
            color: #93c5fd;
        }

        [data-theme="dark"] .badge-overdue {
            background: #2d0a0a;
            border-color: #7f1d1d;
            color: #fca5a5;
        }

        [data-theme="dark"] .btn-success:hover {
            background: #052e16;
        }
    </style>

    <div class="page-head">
        <div>
            <h1 class="page-title">Loans</h1>
            <p class="page-subtitle">Borrow and return books — the main circulation workflow.</p>
        </div>
        <a class="btn btn-ghost" href="{{ route('loans.index') }}">Reset filters</a>
    </div>

    {{-- Stats cards --}}
    <div class="stats">
        <div class="stat">
            <div>
                <p class="k">Total Loans</p>
                <p class="v">{{ $stats['total'] ?? $loans->total() ?? count($loans) }}</p>
            </div>
            <span class="chip">All time</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Active</p>
                <p class="v">{{ $stats['active'] ?? '—' }}</p>
            </div>
            <span class="chip">Borrowed</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Overdue</p>
                <p class="v">{{ $stats['overdue'] ?? '—' }}</p>
            </div>
            <span class="chip">Past due</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Returned</p>
                <p class="v">{{ $stats['returned'] ?? '—' }}</p>
            </div>
            <span class="chip">Completed</span>
        </div>
    </div>

    <div class="layout">

        {{-- LEFT: Borrow a Book --}}
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Borrow a Book</h2>
                    <p class="panel-subtitle">Create a new loan record.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('loans.borrow') }}" class="form">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="member_id">Member <span class="req">*</span></label>
                        <select id="member_id" name="member_id" required>
                            <option value="">Select member…</option>
                            @foreach ($members as $m)
                                <option value="{{ $m->id }}" @selected(old('member_id') == $m->id)>
                                    {{ $m->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="book_id">Book <span class="req">*</span></label>
                        <select id="book_id" name="book_id" required>
                            <option value="">Select book…</option>
                            @foreach ($books as $b)
                                <option value="{{ $b->id }}" @selected(old('book_id') == $b->id)
                                    {{ $b->copies_available < 1 ? 'disabled' : '' }}>
                                    {{ $b->title }} — {{ $b->copies_available }} avail.
                                </option>
                            @endforeach
                        </select>
                        @error('book_id') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="due_at">Due Date</label>
                        <input id="due_at" type="date" name="due_at" value="{{ old('due_at') }}" />
                        <span class="field-hint">Leave blank to auto-set (+7 days from today).</span>
                        @error('due_at') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Confirm Borrow</button>
                    <button class="btn btn-ghost" type="reset">Clear</button>
                </div>

                <p class="hint">Tip: books with 0 copies available are disabled in the list above.</p>
            </form>
        </section>

        {{-- RIGHT: Loan Records --}}
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Loan Records</h2>
                    <p class="panel-subtitle">Filter, track, and process returns.</p>
                </div>
            </div>

            {{-- Toolbar --}}
            <div class="toolbar">
                <form method="GET" action="{{ route('loans.index') }}">
                    <div class="toolbar-grid">

                        <div class="field" style="margin:0;">
                            <label for="q">Search</label>
                            <input id="q" name="q" value="{{ request('q') }}"
                                placeholder="Search book title or member…" />
                        </div>

                        <div class="field" style="margin:0;">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="" {{ request('status') === '' ? 'selected' : '' }}>All</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="overdue" {{ request('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                                <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Returned</option>
                            </select>
                        </div>

                        <div class="field" style="margin:0;">
                            <label for="sort">Sort</label>
                            <select id="sort" name="sort">
                                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="due_soon" {{ request('sort') === 'due_soon' ? 'selected' : '' }}>Due soon</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </div>

                        <div class="actions" style="margin:0;">
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <a class="btn btn-ghost" href="{{ route('loans.index') }}">Clear</a>
                        </div>

                    </div>
                </form>
                <p class="hint">
                    Showing
                    <b>{{ method_exists($loans, 'count') ? $loans->count() : count($loans) }}</b>
                    of
                    <b>{{ $loans->total() ?? count($loans) }}</b>
                    results
                </p>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Member</th>
                            <th>Dates</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loans as $loan)
                            @php
                                $isReturned = (bool) $loan->returned_at;
                                $isOverdue = !$isReturned && $loan->due_at && $loan->due_at < now();
                            @endphp
                            <tr>
                                <td>
                                    <div class="loan-cell">
                                        <span class="title">{{ $loan->book->title }}</span>
                                        <span class="meta">ID: {{ $loan->id }}</span>
                                    </div>
                                </td>
                                <td>{{ $loan->member->name }}</td>
                                <td>
                                    <div class="date-cell">
                                        <span class="date-val">{{ optional($loan->borrowed_at)->format('M j, Y') ?? '—' }}</span>
                                        <span class="date-label">
                                            Due: {{ optional($loan->due_at)->format('M j, Y') ?? 'none' }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if ($isReturned)
                                        <span class="badge badge-returned">Returned</span>
                                    @elseif ($isOverdue)
                                        <span class="badge badge-overdue">Overdue</span>
                                    @else
                                        <span class="badge badge-borrowed">Borrowed</span>
                                    @endif
                                </td>
                                <td class="actions-col">
                                    <div class="row-actions">
                                        @if (!$isReturned)
                                            <form method="POST" action="{{ route('loans.return', $loan) }}">
                                                @csrf
                                                <button class="btn btn-small btn-success" type="submit">
                                                    Mark Returned
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-small" disabled>Done</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty">
                                        <strong>No loans found.</strong>
                                        <p>Try changing your filters or create a new loan on the left.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($loans, 'links'))
                <div class="pagination">
                    {{ $loans->appends(request()->query())->links() }}
                </div>
            @endif
        </section>

    </div>

@endsection