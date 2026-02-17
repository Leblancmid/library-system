<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::get('/', fn() => redirect()->route('books.index'));

Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);

// Borrow / Return endpoints
Route::post('/loans/borrow', [LoanController::class, 'borrow'])->name('loans.borrow');
Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');

