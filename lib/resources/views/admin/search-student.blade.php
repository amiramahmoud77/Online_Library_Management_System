<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #f8f1f1, #d1e7f7);
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background-color: #4e73df !important;
        }

        .navbar .nav-link, .navbar .navbar-brand {
            color: white !important;
            font-weight: 500;
        }

        .search-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .search-container h3 {
            margin-bottom: 20px;
            text-align: center;
            color: #4e73df;
            font-weight: 600;
        }

        .form-control {
            border-radius: 50px;
            padding: 15px 20px;
            border: 1px solid #4e73df;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(78, 115, 223, 0.5);
            border-color: #4e73df;
        }

        .btn-primary {
            border-radius: 50px;
            padding: 10px 25px;
            background: #4e73df;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2e59d9;
            transform: scale(1.05);
        }

        .student-card {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 15px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .student-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="color: white;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.borrowed-books') }}"><i class="fas fa-book-reader"></i> Borrowed Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.books.index') }}"><i class="fas fa-book"></i> All Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> All Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/search-student"><i class="fas fa-search"></i> Search Student</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/profile"><i class="fas fa-user-cog"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}"><i class="fas fa-home"></i> Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Form -->
    <div class="search-container">
        <h3>Search Student</h3>
        <form action="/admin/search-student" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Enter student name" required>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>

        @if(isset($students))
            @if(count($students) > 0)
                @foreach($students as $student)
                    <div class="student-card">
                        <h5>{{ $student->first_name }} {{ $student->last_name }}</h5>
                        <p>Email: {{ $student->email }}</p>
                        <p>Role: {{ ucfirst($student->role) }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-center text-danger">No students found for "{{ $search }}"</p>
            @endif
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

