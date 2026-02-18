@extends('layouts.app')

@section('title', 'Books')

@section('content')

<h2>Edit book</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('books.update', $book->id) }}">
    @csrf
    @method('PUT')

    <label>Title:</label>
    <input type="text" name="title" value="{{ old('title', $book->title) }}">
    <br><br>

    <label>Author:</label>
    <input type="text" name="author" value="{{ old('author', $book->author) }}">
    <br><br>

    <label>ISBN:</label>
    <input type="test" name="isbn" value="{{ old('isbn', $book->isbn) }}">
    <br><br>

    <label>Total Copies:</label>
    <input type="number" name="copies_total" value="{{ old('total_copies', $book->total_copies) }}">
    <br><br>

    <label>Available Copies:</label>
    <input type="number" name="copies_available" value="{{ old('available_copies', $book->available_copies) }}">
    <br><br>

    <button type="submit">Update</button>
</form>