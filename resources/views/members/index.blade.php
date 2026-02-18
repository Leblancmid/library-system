@extends('layouts.app')

@section('title', 'Members')

@section('content')
    <h1>Members</h1>
    <p class="muted">Register members who can borrow books.</p>

    <div class="grid">
        <div class="card">
            <h2>Add Member</h2>
            <form method="POST" action="{{ route('members.store') }}">
                @csrf

                <div class="field">
                    <label>Name</label>
                    <input name="name" value="{{ old('name') }}" required />
                </div>

                <div class="field">
                    <label>Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" />
                </div>

                <div class="field">
                    <label>Phone</label>
                    <input name="phone" value="{{ old('phone') }}" />
                </div>

                <button class="btn primary" type="submit">Save</button>
            </form>
        </div>

        <div class="card">
            <h2>Member List</h2>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th style="width:160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $m)
                        <tr>
                            <td><strong>{{ $m->name }}</strong></td>
                            <td>{{ $m->email ?? '-' }}</td>
                            <td>{{ $m->phone ?? '-' }}</td>
                            <td class="row">
                                <a href="{{ route('members.edit', $m->id) }}" class="btn btn-primary">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('members.destroy', $m) }}"
                                    onsubmit="return confirm('Delete this member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="muted">No members yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if (method_exists($members, 'links'))
                <div style="margin-top:12px;">{{ $members->links() }}</div>
            @endif
        </div>
    </div>
@endsection