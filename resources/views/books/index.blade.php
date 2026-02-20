@extends('layouts.app')

@section('title', 'Books')

@section('content')

    <style>
        /* ========= Tokens (works with your existing CSS vars) ========= */
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

        /* ========= Toolbar (search/filter/sort) ========= */
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

        .num {
            text-align: center;
        }

        .actions-col {
            text-align: right;
        }

        .title-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .title-cell .title {
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .title-cell .meta {
            font-size: 12px;
            color: var(--ink-3);
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .row-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
        }

        /* ========= Badges ========= */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            border: 1px solid var(--border);
        }

        .badge-ok {
            background: #f0fdf4;
            border-color: #86efac;
            color: #15803d;
        }

        .badge-danger {
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

        [data-theme="dark"] .badge-ok {
            background: #052e16;
            border-color: #166534;
            color: #86efac;
        }

        [data-theme="dark"] .badge-danger {
            background: #2d0a0a;
            border-color: #7f1d1d;
            color: #fca5a5;
        }
    </style>

    @php
        // stats (works even if $books is paginated)
        $stats = $stats ?? null; // if controller sends it, use it
    @endphp

    <div class="page-head">
        <div>
            <h1 class="page-title">Books</h1>
            <p class="page-subtitle">Manage your collection, search quickly, and track availability.</p>
        </div>

        {{-- Quick reset link (keeps UX nice) --}}
        <a class="btn btn-ghost" href="{{ route('books.index') }}">Reset filters</a>
    </div>

    {{-- Stats cards --}}
    <div class="stats">
        <div class="stat">
            <div>
                <p class="k">Books</p>
                <p class="v">{{ $stats['books_count'] ?? $books->total() ?? count($books) }}</p>
            </div>
            <span class="chip">Titles</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Total copies</p>
                <p class="v">{{ $stats['copies_total'] ?? '—' }}</p>
            </div>
            <span class="chip">Inventory</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Available</p>
                <p class="v">{{ $stats['copies_available'] ?? '—' }}</p>
            </div>
            <span class="chip">Ready to borrow</span>
        </div>
        <div class="stat">
            <div>
                <p class="k">Out of stock</p>
                <p class="v">{{ $stats['out_of_stock'] ?? '—' }}</p>
            </div>
            <span class="chip">Needs restock</span>
        </div>
    </div>

    <div class="layout">

        {{-- LEFT: Add Book --}}
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Add Book</h2>
                    <p class="panel-subtitle">Create a new book record.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('books.store') }}" class="form">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="title">Title <span class="req">*</span></label>
                        <input id="title" name="title" value="{{ old('title') }}" required placeholder="e.g. Clean Code" />
                        @error('title') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="author">Author</label>
                        <input id="author" name="author" value="{{ old('author') }}" placeholder="e.g. Robert C. Martin" />
                        @error('author') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="isbn">ISBN</label>
                        <input id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="e.g. 9780132350884" />
                        @error('isbn') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="copies_total">Total Copies <span class="req">*</span></label>
                        <input id="copies_total" type="number" name="copies_total" min="1"
                            value="{{ old('copies_total', 1) }}" required />
                        @error('copies_total') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="copies_available">Available Copies <span class="req">*</span></label>
                        <input id="copies_available" type="number" name="copies_available" min="0"
                            value="{{ old('copies_available', 1) }}" required />
                        @error('copies_available') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Save Book</button>
                    <button class="btn btn-ghost" type="reset">Clear</button>
                </div>

                <p class="hint">Tip: keep <b>Available ≤ Total</b>. (We’ll enforce this in validation below.)</p>
            </form>
        </section>

        {{-- RIGHT: Book List --}}
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Book List</h2>
                    <p class="panel-subtitle">Search, filter, sort, edit, or remove books.</p>
                </div>
            </div>

            {{-- Toolbar --}}
            <div class="toolbar">
                <form method="GET" action="{{ route('books.index') }}">
                    <div class="toolbar-grid">

                        <div class="field" style="margin:0;">
                            <label for="q">Search</label>
                            <input id="q" name="q" value="{{ request('q') }}"
                                placeholder="Search title, author, or ISBN…" />
                        </div>

                        <div class="field" style="margin:0;">
                            <label for="availability">Availability</label>
                            <select id="availability" name="availability">
                                <option value="" {{ request('availability') === '' ? 'selected' : '' }}>All</option>
                                <option value="available" {{ request('availability') === 'available' ? 'selected' : '' }}>
                                    Available</option>
                                <option value="out" {{ request('availability') === 'out' ? 'selected' : '' }}>Out of stock
                                </option>
                            </select>
                        </div>

                        <div class="field" style="margin:0;">
                            <label for="sort">Sort</label>
                            <select id="sort" name="sort">
                                <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest
                                </option>
                                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title (A–Z)</option>
                                <option value="author" {{ request('sort') === 'author' ? 'selected' : '' }}>Author (A–Z)
                                </option>
                                <option value="available_desc" {{ request('sort') === 'available_desc' ? 'selected' : '' }}>
                                    Available (High–Low)</option>
                                <option value="total_desc" {{ request('sort') === 'total_desc' ? 'selected' : '' }}>Total
                                    (High–Low)</option>
                            </select>
                        </div>

                        <div class="actions" style="margin:0;">
                            <button class="btn btn-primary" type="submit">Apply</button>
                            <a class="btn btn-ghost" href="{{ route('books.index') }}">Clear</a>
                        </div>

                    </div>
                </form>
                <p class="hint">
                    Showing
                    <b>{{ method_exists($books, 'count') ? $books->count() : count($books) }}</b>
                    of
                    <b>{{ $books->total() ?? (count($books) ?? 0) }}</b>
                    results
                </p>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th class="num">Available</th>
                            <th class="num">Total</th>
                            <th class="actions-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $b)
                            <tr>
                                <td>
                                    <div class="title-cell">
                                        <span class="title">{{ $b->title }}</span>
                                        <span class="meta">
                                            @if($b->isbn) <span>ISBN: {{ $b->isbn }}</span> @endif
                                            <span>ID: {{ $b->id }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $b->author ?? '—' }}</td>
                                <td class="num">
                                    <span class="badge {{ $b->copies_available < 1 ? 'badge-danger' : 'badge-ok' }}">
                                        {{ $b->copies_available }}
                                    </span>
                                </td>
                                <td class="num">{{ $b->copies_total }}</td>
                                <td class="actions-col">
                                    <div class="row-actions">
                                        <a href="{{ route('books.edit', $b->id) }}" class="btn btn-small">Edit</a>

                                        <form method="POST" action="{{ route('books.destroy', $b) }}"
                                            onsubmit="return confirm('Delete this book?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-small btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty">
                                        <strong>No books found.</strong>
                                        <p>Try changing your search or add your first book on the left.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($books, 'links'))
                <div class="pagination">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            @endif
        </section>

    </div>
@endsection