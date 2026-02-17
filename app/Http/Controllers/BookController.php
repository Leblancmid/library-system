<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:255', 'unique:books,isbn'],
            'copies_total' => ['required', 'integer', 'min:1'],
            'copies_available' => ['required', 'integer', 'min:0'],
        ]);

        Book::create($data);

        return redirect()->route('books.index')->with('status', 'Book added!');
    }
}
