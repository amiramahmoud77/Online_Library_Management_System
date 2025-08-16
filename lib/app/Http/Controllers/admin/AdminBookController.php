<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminBookController extends Controller
{
    // عرض كل الكتب للأدمن
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books')); // راجع الفولدر admin/books
    }

    // صفحة إضافة كتاب جديد
    public function create()
    {
        return view('admin.books.create');
    }

    // حفظ الكتاب الجديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $book->image = $path;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully!');
    }

    // صفحة تعديل كتاب موجود
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    // تحديث الكتاب
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة لو موجودة
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $path = $request->file('image')->store('books', 'public');
            $book->image = $path;
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully!');
    }

    // حذف الكتاب
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully!');
    }
}
