<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="{{ asset('book.ico') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('book.ico') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            background: linear-gradient(to right, #eef2ff, #e0e7ff);
            overflow-x: hidden;
        }
        /* Navbar */
        nav {
            background: rgba(79, 70, 229, 0.95);
            padding: 1rem 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: slideDown 1s ease-out;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #ffdd57;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            animation: fadeIn 1.5s ease-out;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: float 3s ease-in-out infinite;
        }
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }
        .hero a {
            background-color: white;
            color: #4f46e5;
            padding: 0.9rem 1.8rem;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.4s ease;
        }
        .hero a:hover {
            background-color: #ffdd57;
            color: #333;
            transform: scale(1.1);
        }

        /* Features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 3rem 2rem;
            max-width: 1100px;
            margin: auto;
        }
        .feature {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            transform: translateY(50px);
            opacity: 0;
            animation: fadeUp 1s ease forwards;
        }
        .feature:nth-child(1) { animation-delay: 0.3s; }
        .feature:nth-child(2) { animation-delay: 0.6s; }
        .feature:nth-child(3) { animation-delay: 0.9s; }

        .feature:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: all 0.4s ease;
        }

        /* Footer */
        footer {
            background-color: #4f46e5;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
            animation: fadeIn 1.5s ease-out;
        }

        /* Animations */
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
@if (Route::has('login'))
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="logo text-xl font-bold text-purple-700">📚 My Library</div>
        <div class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-purple-700 hover:text-purple-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-purple-700 hover:text-purple-500">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-purple-700 hover:text-purple-500">Register</a>
                @endif
                <a href="{{ route('admin.login') }}" class="text-purple-700 hover:text-purple-500">Admin</a>
            @endauth
        </div>
    </nav>
@endif

    {{-- Hero Section --}}
    <div class="hero">
        <h1>Welcome to Our Online Library</h1>
        <p>Discover, borrow, and enjoy books anytime, anywhere.</p>
        <a href="{{ route('register') }}">Get Started</a>
    </div>

    {{-- Features --}}
    <div class="features">
        <div class="feature">
            <h2>📖 Browse Books</h2>
            <p>Explore our collection of books from all genres.</p>
        </div>
        <div class="feature">
            <h2>📚 Borrow Easily</h2>
            <p>Borrow books with one click and track return dates.</p>
        </div>
        <div class="feature">
            <h2>🛠 Admin Tools</h2>
            <p>Manage users and books with powerful admin features.</p>
        </div>
    </div>

    {{-- Footer --}}
    <footer>
        &copy; {{ date('Y') }} My Library. All rights reserved.
    </footer>
</body>
</html>

