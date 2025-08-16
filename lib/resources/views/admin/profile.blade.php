<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(to right, #f0f2f5, #e0e4f1);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
        }
        .profile-card {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }
        .profile-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: rgba(0, 123, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(20px); }
        }
        .profile-card h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px #007bff;
            border-color: #007bff;
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-danger {
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #007bff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" href="{{ route('admin.dashboard') }}">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.borrowed-books') }}"><i class="fas fa-book-reader"></i> Borrowed Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.books.index') }}"><i class="fas fa-book"></i> All Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/users"><i class="fas fa-users"></i> All Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/search-student"><i class="fas fa-search"></i> Search Student</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/admin/profile"><i class="fas fa-user-cog"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}"><i class="fas fa-home"></i> Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Card -->
    <div class="profile-card">
        <h3>Admin Profile</h3>

        <!-- Profile Photo -->
        <div class="text-center">
            <img src="{{ Auth::user()->photo ?? 'https://via.placeholder.com/100' }}" alt="Profile Photo" class="profile-photo">
        </div>

        <!-- Update Form -->
        <form action="{{ route('admin.profile.update') }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone ?? '' }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="{{ Auth::user()->address ?? '' }}">
            </div>

            <div class="form-group">
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <form action="{{ route('admin.profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete Profile</button>
</form>

            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

