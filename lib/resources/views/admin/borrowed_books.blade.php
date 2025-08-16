<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed Books</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f9f4ef;
            font-family: 'Segoe UI', sans-serif;
        }
        .table-title {
            text-align: center;
            margin-top: 40px;
            color: #6a0dad;
            font-weight: bold;
            font-size: 2rem;
        }
        .table {
            background-color: #fff;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .table th {
            background: linear-gradient(90deg, #6a0dad, #a75dbf);
            color: #f9f4ef !important;
            font-weight: bold;
        }
        .table td {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f1e8dc;
            transition: all 0.3s ease;
        }
        .btn-return {
            background-color: #6a0dad;
            color: #f9f4ef;
            border: none;
        }
        .btn-return:hover {
            background-color: #a75dbf;
            color: #fff;
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

    <!-- Table Title -->
    <div class="table-title">Borrowed Books List</div>

    <!-- Borrowed Books Table -->
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Student Name</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrows as $borrow)
                        <tr>
                            <td>{{ $borrow->book->title ?? 'N/A' }}</td>
                            <td>{{ $borrow->user->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('Y-m-d') ?? 'N/A' }}</td> <!-- تحويل String لـ Date -->
                            <td>{{ \Carbon\Carbon::parse($borrow->return_date)->format('Y-m-d') ?? 'N/A' }}</td> <!-- تحويل String لـ Date -->
                            <td>
                               <form action="{{ route('books.return', ['book' => $borrow->book_id, 'user_id' => $borrow->user_id]) }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="borrow_id" value="{{ $borrow->id }}">
    <button type="submit" class="btn btn-return btn-sm">Return</button>
</form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No borrowed books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
