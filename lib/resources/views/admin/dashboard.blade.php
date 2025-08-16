<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .dashboard-box {
            background-color: #fff;
            border-left: 5px solid #4a90e2;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .dashboard-box:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .dashboard-box h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 5px;
        }
        .dashboard-box p {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4a90e2;
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

    <!-- Dashboard Boxes -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-box">
                    <h3>Borrowed Books</h3>
                    <p>{{ $borrowedBooks }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-box">
                    <h3>All Books</h3>
                    <p>{{ $allBooks }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-box">
                    <h3>All Users</h3>
                    <p>{{ $allUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>