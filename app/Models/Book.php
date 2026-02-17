<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author','isbn','copies_total','copies_available'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

