<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public $fillable = ['book_id', 'member_id', 'borrowed_at', 'due_at', 'returned_at'];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }
    public function member() {
        return $this->belongsTo(Member::class);
    }

}
