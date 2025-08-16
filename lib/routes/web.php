<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AdminBookController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/dashboard', [BorrowController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/admin/borrowed-books', [AdminController::class, 'borrowedBooks'])->name('admin.borrowed.books');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('books')->group(function () {
   Route::post('/books/{book}/return/{user_id}', [BookController::class, 'returnBook'])->name('books.return');
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/borrowed', [BorrowController::class, 'index'])->name('borrowed.index');
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::post('/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow')->middleware('auth');
    Route::post('/{book}/return', [BookController::class, 'returnBook'])->name('books.return');
});Route::post('/borrows/{borrow}/request-extension', [BorrowController::class, 'requestExtension'])->name('borrows.request-extension');
Route::post('/books/{book}/return', [BorrowController::class, 'returnBook'])->name('books.return');

// Admin login routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.process');

// Admin dashboard route
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/borrowed-books', [AdminController::class, 'borrowedBooks'])
    ->name('admin.borrowed-books')
    ->middleware('auth');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', App\Http\Controllers\Admin\BookController::class);
});
Route::get('/admin/search-student', [AdminController::class, 'searchStudent'])->name('admin.search-student');
Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::put('admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
Route::delete('admin/profile/destroy', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', BookController::class);
});
Route::get('/admin/users', [AdminController::class, 'users'])
    ->name('admin.users')
    ->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('books', AdminBookController::class);
});
Route::post('/books/{book}/return/{user_id}', [BorrowController::class, 'returnBook'])->name('books.return');

require __DIR__.'/auth.php';
