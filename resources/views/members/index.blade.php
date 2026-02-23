@extends('layouts.app')

@section('title', 'Members')

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
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 520px) {
            .stats {
                grid-template-columns: 1fr;
            }
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
            .layout {
                grid-template-columns: 1fr;
            }
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

        .req {
            color: var(--accent);
        }

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

        .btn:active {
            transform: translateY(1px);
        }

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

        .btn-danger {
            border-color: #fca5a5;
            color: var(--accent);
            background: transparent;
        }

        .btn-danger:hover {
            background: #fff1f2;
            border-color: var(--accent);
        }

        /* ========= Toolbar ========= */
        .toolbar {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg) 70%, transparent);
        }

        .toolbar-grid {
            display: grid;
            grid-template-columns: 1fr 180px auto;
            gap: 10px;
            align-items: end;
        }

        @media (max-width: 980px) {
            .toolbar-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 560px) {
            .toolbar-grid {
                grid-template-columns: 1fr;
            }
        }

        .hint {
            font-size: 12px;
            color: var(--ink-3);
            margin: 6px 0 0;
        }

        /* ========= Table ========= */
        .table-wrap {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
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

        .actions-col {
            text-align: right;
        }

        .member-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background: color-mix(in srgb, var(--accent-2) 60%, transparent);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            color: var(--ink-2);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .member-info .name {
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .member-info .member-id {
            font-size: 12px;
            color: var(--ink-3);
        }

        .contact-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .contact-cell .email {
            font-size: 13px;
        }

        .contact-cell .phone {
            font-size: 12px;
            color: var(--ink-3);
        }

        .row-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
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

        [data-theme="dark"] .btn-danger:hover {
            background: #2d0a0a;
            border-color: #7f1d1d;
        }
    </style>

    <div class="page-head">
        <div>
            <h1 class="page-title">Members</h1>
            <p class="page-subtitle">Register and manage members who can borrow books.</p>
        </div>
        <a class="btn btn-ghost" href="{{ route('members.index') }}">Reset filters</a>
    </div>

    {{-- Stats cards --}}
    <div class="stats">
        <div class="stat">
            <div>
                <p class="k">Members</p>
                <p class="v">{{ $stats['members_count'] ?? $members->total() ?? count($members) }}</p>
            </div>
            <span class="chip">Registered</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Active Borrows</p>
                <p class="v">{{ $stats['active_borrows'] ?? '—' }}</p>
            </div>
            <span class="chip">Ongoing</span>
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
                <p class="k">New This Month</p>
                <p class="v">{{ $stats['new_this_month'] ?? '—' }}</p>
            </div>
            <span class="chip">Recent</span>
        </div>
    </div>

    <div class="layout">

        {{-- LEFT: Add Member --}}
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Add Member</h2>
                    <p class="panel-subtitle">Register a new borrower.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('members.store') }}" class="form">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="name">Name <span class="req">*</span></label>
                        <input id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Jane Reyes" />
                        @error('name') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="e.g. jane@example.com" />
                        @error('email') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g. +63 912 345 6789" />
                        @error('phone') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Save Member</button>
                    <button class="btn btn-ghost" type="reset">Clear</button>
                </div>

                <p class="hint">Tip: email or phone is recommended for easy follow-up on overdue books.</p>
            </form>
        </section>

        {{-- RIGHT: Member List --}}
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Member List</h2>
                    <p class="panel-subtitle">Search, edit, or remove members.</p>
                </div>
            </div>

            {{-- Toolbar --}}
            <div class="toolbar">
                <form method="GET" action="{{ route('members.index') }}">
                    <div class="toolbar-grid">

                        <div class="field" style="margin:0;">
                            <label for="q">Search</label>
                            <input id="q" name="q" value="{{ request('q') }}" placeholder="Search name, email, or phone…" />
                        </div>

                        <div class="field" style="margin:0;">
                            <label for="sort">Sort</label>
                            <select id="sort" name="sort">
                                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest
                                </option>
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A–Z)</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest first
                                </option>
                            </select>
                        </div>

                        <div class="actions" style="margin:0;">
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <a class="btn btn-ghost" href="{{ route('members.index') }}">Clear</a>
                        </div>

                    </div>
                </form>
                <p class="hint">
                    Showing
                    <b>{{ method_exists($members, 'count') ? $members->count() : count($members) }}</b>
                    of
                    <b>{{ $members->total() ?? count($members) }}</b>
                    results
                </p>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Contact</th>
                            <th class="actions-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $m)
                            <tr>
                                <td>
                                    <div class="member-cell">
                                        <div class="avatar">{{ mb_substr($m->name, 0, 1) }}</div>
                                        <div class="member-info">
                                            <div class="name">{{ $m->name }}</div>
                                            <div class="member-id">ID: {{ $m->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="contact-cell">
                                        <span class="email">{{ $m->email ?? '—' }}</span>
                                        @if($m->phone)
                                            <span class="phone">{{ $m->phone }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="actions-col">
                                    <div class="row-actions">
                                        <a href="{{ route('members.edit', $m->id) }}" class="btn btn-small">Edit</a>

                                        <form method="POST" action="{{ route('members.destroy', $m) }}"
                                            onsubmit="return confirm('Delete this member?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-small btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="empty">
                                        <strong>No members found.</strong>
                                        <p>Try changing your search or register your first member on the left.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($members, 'links'))
                <div class="pagination">
                    {{ $members->appends(request()->query())->links() }}
                </div>
            @endif
        </section>

    </div>

@endsection