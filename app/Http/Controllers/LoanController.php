<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book','member'])
            ->latest()
            ->paginate(10);

        $books = Book::orderBy('title')->get();
        $members = Member::orderBy('name')->get();

        return view('loans.index', compact('loans', 'books', 'members'));
    }

    public function borrow(Request $request)
    {
        $data = $request->validate([
            'book_id' => ['required', Rule::exists('books', 'id')],
            'member_id' => ['required', Rule::exists('members', 'id')],
            'due_at' => ['nullable', 'date'],
        ]);

        return DB::transaction(function () use ($data) {
            // lock row to prevent race condition
            $book = Book::whereKey($data['book_id'])->lockForUpdate()->first();

            if ($book->copies_available < 1) {
                return back()->withErrors(['book_id' => 'No available copies for this book.']);
            }

            $loan = Loan::create([
                'book_id' => $book->id,
                'member_id' => $data['member_id'],
                'borrowed_at' => now(),
                'due_at' => $data['due_at'] ?? now()->addDays(7),
            ]);

            $book->decrement('copies_available');

            return redirect()->route('loans.index')->with('status', 'Book borrowed successfully.');
        });
    }

    public function return(Loan $loan)
    {
        if ($loan->returned_at) {
            return back()->withErrors(['loan' => 'This loan is already returned.']);
        }

        return DB::transaction(function () use ($loan) {
            $loan->update(['returned_at' => now()]);
            $loan->book()->lockForUpdate()->first()->increment('copies_available');

            return redirect()->route('loans.index')->with('status', 'Book returned successfully.');
        });
    }
}
