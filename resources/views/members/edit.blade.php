@extends('layouts.app')

@section('title', 'Edit Member')

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
            margin-bottom: 24px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--ink-3);
            margin: 0 0 6px;
        }

        .breadcrumb a {
            color: var(--ink-3);
            text-decoration: none;
            transition: color .15s;
        }

        .breadcrumb a:hover {
            color: var(--ink);
        }

        .breadcrumb .sep {
            opacity: .4;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -.6px;
            color: var(--ink);
            margin: 0;
        }

        .page-title span {
            color: var(--ink-3);
            font-weight: 400;
        }

        /* ========= Layout ========= */
        .layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 16px;
            align-items: start;
        }

        @media (max-width: 860px) {
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
            padding: 20px;
        }

        .section-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--ink-3);
            margin: 0 0 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
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

        .field input {
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
            box-sizing: border-box;
        }

        .field input:focus {
            border-color: var(--ink-3);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--ink) 10%, transparent);
        }

        .field input:active {
            transform: translateY(1px);
        }

        .error {
            font-size: 12px;
            color: var(--accent);
        }

        /* ========= Error alert ========= */
        .alert-error {
            background: #fff1f2;
            border: 1px solid #fca5a5;
            border-radius: var(--radius-sm);
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .alert-error .alert-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--accent);
            margin: 0 0 6px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 16px;
        }

        .alert-error li {
            font-size: 13px;
            color: var(--accent);
            margin-bottom: 2px;
        }

        /* ========= Form actions ========= */
        .form-actions {
            display: flex;
            gap: 8px;
            padding: 16px 20px;
            border-top: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg) 70%, transparent);
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

        /* ========= Side info card ========= */
        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 2px 12px rgba(26, 23, 20, .06);
            overflow: hidden;
        }

        .info-card-head {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -.2px;
        }

        .info-list {
            padding: 6px 0;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 16px;
            border-bottom: 1px solid var(--border);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-key {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--ink-3);
            flex-shrink: 0;
        }

        .info-val {
            font-size: 13px;
            color: var(--ink);
            text-align: right;
            word-break: break-all;
        }

        /* ========= Avatar ========= */
        .avatar-block {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 999px;
            background: color-mix(in srgb, var(--accent-2) 60%, transparent);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
            color: var(--ink-2);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .avatar-name {
            font-weight: 700;
            font-size: 14px;
            color: var(--ink);
            letter-spacing: -.2px;
        }

        .avatar-id {
            font-size: 12px;
            color: var(--ink-3);
            margin-top: 2px;
        }

        /* ========= Dark mode ========= */
        [data-theme="dark"] .panel,
        [data-theme="dark"] .info-card {
            box-shadow: 0 2px 14px rgba(0, 0, 0, .35);
        }

        [data-theme="dark"] .alert-error {
            background: #2d0a0a;
            border-color: #7f1d1d;
        }
    </style>

    {{-- Page header --}}
    <div class="page-head">
        <div>
            <nav class="breadcrumb">
                <a href="{{ route('members.index') }}">Members</a>
                <span class="sep">›</span>
                <span>Edit</span>
            </nav>
            <h1 class="page-title">Edit <span>/ {{ $member->name }}</span></h1>
        </div>
        <a class="btn btn-ghost" href="{{ route('members.index') }}">← Back to Members</a>
    </div>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert-error">
            <p class="alert-title">Please fix the following errors:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="layout">

        {{-- LEFT: Edit form --}}
        <div class="panel">
            <div class="panel-head">
                <h2 class="panel-title">Member Details</h2>
                <p class="panel-subtitle">Update the information below and save your changes.</p>
            </div>

            <form method="POST" action="{{ route('members.update', $member->id) }}">
                @csrf
                @method('PUT')

                <div class="form">
                    <p class="section-label">Personal Info</p>

                    <div class="field">
                        <label for="name">Name <span class="req">*</span></label>
                        <input id="name" name="name" value="{{ old('name', $member->name) }}" required
                            placeholder="e.g. Jane Reyes" />
                        @error('name') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $member->email) }}"
                            placeholder="e.g. jane@example.com" />
                        @error('email') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" value="{{ old('phone', $member->phone) }}"
                            placeholder="e.g. +63 912 345 6789" />
                        @error('phone') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                    <a class="btn btn-ghost" href="{{ route('members.index') }}">Cancel</a>
                </div>

            </form>
        </div>

        {{-- RIGHT: Current record snapshot --}}
        <div class="info-card">
            <div class="info-card-head">Current Record</div>

            <div class="avatar-block">
                <div class="avatar">{{ mb_substr($member->name, 0, 1) }}</div>
                <div>
                    <div class="avatar-name">{{ $member->name }}</div>
                    <div class="avatar-id">Member #{{ $member->id }}</div>
                </div>
            </div>

            <div class="info-list">
                <div class="info-row">
                    <span class="info-key">Email</span>
                    <span class="info-val">{{ $member->email ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-key">Phone</span>
                    <span class="info-val">{{ $member->phone ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-key">Registered</span>
                    <span class="info-val">{{ $member->created_at?->format('M j, Y') ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-key">Updated</span>
                    <span class="info-val">{{ $member->updated_at?->format('M j, Y') ?? '—' }}</span>
                </div>
            </div>
        </div>

    </div>

@endsection