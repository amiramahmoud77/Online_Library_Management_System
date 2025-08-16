<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;

class BookController extends Controller
{
    public function index() {
        $categories = Category::all(); 
        return view('admin.books.create', compact('categories'));
    }

    public function show(string $id)
    {
        $book = Book::with('user', 'category')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function borrow(Book $book)
    {
        if ($book->available_copies > 0) {
            Borrow::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'admin_id' => 1, // ضع admin المناسب
                'status' => 'borrowed',
                'borrow_date' => Carbon::now(),
                'return_date' => Carbon::now()->addDays(7),
            ]);

            $book->decrement('available_copies');
            return redirect('/dashboard')->with('success', 'Book borrowed successfully!');
        }
        return redirect()->back()->with('error', 'No copies available!');
    }

  public function store(Request $request)
{
    // Validate البيانات
    $request->validate([
        'name' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'available_copies' => 'required|integer',
        'price' => 'required|numeric',
        'publish_year' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $book = new Book();
    $book->name = $request->name;
    $book->author = $request->author;
    $book->description = $request->description;
    $book->available_copies = $request->available_copies;
    $book->price = $request->price;
    $book->publish_year = $request->publish_year;
    $book->category_id = $request->category_id;
    $book->user_id = auth()->id(); 

    
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/books'), $filename);
        $book->photo = $filename;
    }

   
    $book->save();

    return redirect()->back()->with('success', 'Book added successfully!');
}


    public function update(UpdateBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($book->photo && Storage::exists($book->photo)) {
                Storage::delete($book->photo);
            }
            $data['photo'] = $request->file('photo')->store('public/books');
        }

        $book->update($data);
        return response()->json(['message' => 'Book updated successfully']);
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if ($book->photo && Storage::exists($book->photo)) {
            Storage::delete($book->photo);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }

     public function create()
    {
        $categories = Category::all(); 
        return view('admin.books.create', compact('categories'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    
  public function returnBook(Request $request, Book $book)
{
    $borrow = Borrow::where('book_id', $book->id)->where('user_id', $request->user_id)->where('status', 'borrowed')->first();
    if ($borrow) {
        $borrow->update(['status' => 'returned']);
        $book->increment('available_copies');
        return redirect('/admin/borrowed-books')->with('success', 'Book returned successfully!');
    }
    return redirect()->back()->with('error', 'Cannot return this book!');
}
    public function borrowBook($bookId)
{
    Borrow::create([
        'user_id' => auth()->id(),
        'book_id' => $bookId,
        'borrow_date' => now(),
        'return_date' => now()->addDays(7), // أو حسب المدة اللي تحدديها
        'status' => 'borrowed'
    ]);

    return redirect()->back()->with('success', 'Book borrowed successfully!');
}


}

