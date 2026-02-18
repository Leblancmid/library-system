@extends('layouts.app')

@section('title', 'Members')

@section('content')

<h2>Edit Member</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('members.update', $member->id) }}">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $member->name) }}">
    <br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="{{ old('phone', $member->phone) }}">
    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $member->email) }}">
    <br><br>

    <button type="submit">Update</button>
</form>