@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <h1>Loans</h1>
    <p class="muted">Borrow and return books. This is the main backend workflow.</p>

    <div class="grid">
        <div class="card">
            <h2>Borrow a Book</h2>

            <form method="POST" action="{{ route('loans.borrow') }}">
                @csrf

                <div class="field">
                    <label>Member</label>
                    <select name="member_id" required>
                        <option value="">Select member...</option>
                        @foreach ($members as $m)
                            <option value="{{ $m->id }}" @selected(old('member_id') == $m->id)>{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label>Book</label>
                    <select name="book_id" required>
                        <option value="">Select book...</option>
                        @foreach ($books as $b)
                            <option value="{{ $b->id }}" @selected(old('book_id') == $b->id)>
                                {{ $b->title }} (Avail: {{ $b->copies_available }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label>Due date (optional)</label>
                    <input type="date" name="due_at" value="{{ old('due_at') }}" />
                    <div class="muted">If empty, backend will set default (example: +7 days).</div>
                </div>

                <button class="btn primary" type="submit">Borrow</button>
            </form>
        </div>

        <div class="card">
            <h2>Loan Records</h2>

            <table>
                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Member</th>
                        <th>Borrowed</th>
                        <th>Due</th>
                        <th>Status</th>
                        <th style="width:160px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($loans as $loan)
                        <tr>
                            <td><strong>{{ $loan->book->title }}</strong></td>
                            <td>{{ $loan->member->name }}</td>
                            <td>{{ optional($loan->borrowed_at)->format('Y-m-d') }}</td>
                            <td>{{ optional($loan->due_at)->format('Y-m-d') ?? '-' }}</td>
                            <td>
                                @if ($loan->returned_at)
                                    <span class="badge">Returned</span>
                                @else
                                    <span class="badge">Borrowed</span>
                                @endif
                            </td>
                            <td>
                                @if (!$loan->returned_at)
                                    <form method="POST" action="{{ route('loans.return', $loan) }}">
                                        @csrf
                                        <button class="btn primary" type="submit">Return</button>
                                    </form>
                                @else
                                    <button class="btn" disabled>Done</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="muted">No loans yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if (method_exists($loans, 'links'))
                <div style="margin-top:12px;">{{ $loans->links() }}</div>
            @endif
        </div>
    </div>
@endsection