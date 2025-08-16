<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrow_date', 'return_date', 'status'];

    protected $dates = ['borrow_date', 'return_date', 'created_at', 'updated_at']; // هنا بنحدد إن الحقول دي Dates

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}







