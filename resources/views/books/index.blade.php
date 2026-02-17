@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <h1>Books</h1>
    <p class="muted">Manage books and available copies.</p>

    <div class="grid">
        <div class="card">
            <h2>Add Book</h2>
            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                <div class="field">
                    <label>Title</label>
                    <input name="title" value="{{ old('title') }}" required />
                </div>

                <div class="field">
                    <label>Author</label>
                    <input name="author" value="{{ old('author') }}" />
                </div>

                <div class="field">
                    <label>ISBN</label>
                    <input name="isbn" value="{{ old('isbn') }}" />
                </div>

                <div class="row">
                    <div class="field" style="flex:1">
                        <label>Total Copies</label>
                        <input type="number" name="copies_total" min="1" value="{{ old('copies_total', 1) }}" required />
                    </div>

                    <div class="field" style="flex:1">
                        <label>Available Copies</label>
                        <input type="number" name="copies_available" min="0" value="{{ old('copies_available', 1) }}"
                            required />
                    </div>
                </div>

                <button class="btn primary" type="submit">Save</button>
            </form>
        </div>

        <div class="card">
            <h2>Book List</h2>

            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Available</th>
                        <th>Total</th>
                        <th style="width:160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $b)
                        <tr>
                            <td><strong>{{ $b->title }}</strong></td>
                            <td>{{ $b->author ?? '-' }}</td>
                            <td><span class="badge">{{ $b->copies_available }}</span></td>
                            <td>{{ $b->copies_total }}</td>
                            <td class="row">
                                {{-- Keep minimal: delete only --}}
                                <form method="POST" action="{{ route('books.destroy', $b) }}"
                                    onsubmit="return confirm('Delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="muted">No books yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- If you paginate in controller --}}
            @if (method_exists($books, 'links'))
                <div style="margin-top:12px;">{{ $books->links() }}</div>
            @endif
        </div>
    </div>
@endsection