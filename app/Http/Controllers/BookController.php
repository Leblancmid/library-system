<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $availability = $request->query('availability');
        $sort = $request->query('sort', 'latest');
    
        $booksQuery = Book::query();
    
        // Search
        if ($q) {
            $booksQuery->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('author', 'like', "%{$q}%")
                  ->orWhere('isbn', 'like', "%{$q}%");
            });
        }
    
        // Filter
        if ($availability === 'available') {
            $booksQuery->where('copies_available', '>', 0);
        } elseif ($availability === 'out') {
            $booksQuery->where('copies_available', '<', 1);
        }
    
        // Sort
        match ($sort) {
            'title' => $booksQuery->orderBy('title'),
            'author' => $booksQuery->orderBy('author'),
            'available_desc' => $booksQuery->orderByDesc('copies_available'),
            'total_desc' => $booksQuery->orderByDesc('copies_total'),
            default => $booksQuery->latest(),
        };
    
        $books = $booksQuery->paginate(5)->withQueryString();
    
        // Stats (overall, not filtered)
        $stats = [
            'books_count' => Book::count(),
            'copies_total' => (int) Book::sum('copies_total'),
            'copies_available' => (int) Book::sum('copies_available'),
            'out_of_stock' => (int) Book::where('copies_available', '<', 1)->count(),
        ];
    
        return view('books.index', compact('books', 'stats'));
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

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:255', 'unique:books,isbn'],
            'copies_total' => ['required', 'integer', 'min:1'],
            'copies_available' => ['required', 'integer', 'min:0', 'lte:copies_total'],
        ]);

        $book->update($validated);

        return redirect()
        ->route('books.index')
        ->with('messages', 'Books updated successfully!');
    }

    public function destroy(Book $book) 
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully!'
        ], status: 200);
    }
}
