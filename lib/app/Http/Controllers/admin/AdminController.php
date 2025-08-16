<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow;
use App\Models\User;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('status', 'Welcome, Admin!');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'You are not an Admin!'])->withInput();
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials!'])->withInput();
    }
    public function dashboard()
{
    $borrowedBooks = \App\Models\Borrow::whereNull('returned_at')->count();
    $allBooks = \App\Models\Book::count();
    $allUsers = \App\Models\User::count();

    return view('admin.dashboard', compact('borrowedBooks', 'allBooks', 'allUsers'));
}
  public function borrowedBooks()
    {
       
        $borrows = Borrow::with(['book', 'user'])->get();

        return view('admin.borrowed_books', compact('borrows'));
    }
   public function searchStudent(Request $request)
{
    $search = $request->input('name');

    $students = User::where('role', 'student')
        ->where(function($query) use ($search) {
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
        })
        ->get();

    return view('admin.search-student', compact('students', 'search'));
}
public function destroyProfile(Request $request)
{
    $user = Auth::user();
    Auth::logout();
    $user->delete();
    return redirect('/login')->with('success', 'Profile deleted successfully!');
}
  public function profile()
    {
        $admin = auth()->user(); 
        return view('admin.profile', compact('admin'));
    }

    
   public function update(Request $request)
{
    $user = Auth::user();

    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}
public function users()
{
   
    $users = User::where('role', '!=', 'admin')->get();
    return view('admin.users', compact('users'));
}

}