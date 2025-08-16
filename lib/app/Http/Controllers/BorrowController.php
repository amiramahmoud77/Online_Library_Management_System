<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $borrowedBooks = Borrow::where('user_id', Auth::id())->with('book')->get();
        return view('dashboard', compact('borrowedBooks'));
    }

    public function borrow(Book $book)
    {
        if ($book->available_copies > 0) {
            $book->available_copies--;
            $book->save();

            Borrow::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'admin_id' => 1,
                'status' => 'borrowed',
                'borrow_date' => now(),
                'return_date' => now()->addDays(7),
            ]);

            return redirect()->route('dashboard')->with('success', 'Book borrowed successfully!');
        } else {
            return redirect()->back()->with('error', 'No copies available!');
        }
    }

    public function requestExtension(Request $request, $borrowId)
    {
        $borrow = Borrow::findOrFail($borrowId);
        if ($borrow->user_id === Auth::id()) {
            $borrow->return_date = now()->addDays(7);
            $borrow->status = 'extension_requested';
            $borrow->save();

            return redirect()->route('dashboard')->with('success', 'Extension requested successfully! Waiting for admin approval.');
        }
        return redirect()->back()->with('error', 'Unauthorized action!');
    }

    public function returnBook(Request $request, Book $book)
    {
        $borrow = Borrow::where('book_id', $book->id)->where('user_id', Auth::id())->where('status', 'borrowed')->firstOrFail();
        
        // زيادة عدد النسخ المتاحة
        $book->available_copies++;
        $book->save();

        // حذف السجل أو تغيير الـ status
        $borrow->status = 'returned';
        $borrow->save();

        return redirect()->route('dashboard')->with('success', 'Book returned successfully!');
    }
}