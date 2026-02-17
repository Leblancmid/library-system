<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;

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
        
    }
}
