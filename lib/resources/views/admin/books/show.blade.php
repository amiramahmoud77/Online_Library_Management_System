<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 dark:text-purple-300 leading-tight animate-bounce">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="full-page d-flex justify-content-center align-items-center min-h-screen bg-gradient-to-br from-purple-100 to-purple-200">
        <div class="book-card shadow-2xl animate__animated animate__fadeInUp bg-white/95 rounded-2xl p-6 max-w-4xl w-full transform transition-all duration-300 hover:scale-105">
            <div class="row g-0 flex-col md:flex-row">
                <div class="col-md-5 d-flex justify-content-center items-center p-4 order-2 md:order-1">
                    <img src="{{ asset($book->photo) }}" class="img-fluid rounded-xl animate__animated animate__zoomIn shadow-lg max-h-96 w-auto object-cover" alt="{{ $book->name }}">
                </div>
                <div class="col-md-7 order-1 md:order-2">
                    <div class="card-body text-center md:text-left p-6">
                        <h2 class="card-title text-3xl font-extrabold text-purple-800 dark:text-purple-300 animate__animated animate__fadeInDown mb-4">{{ $book->name }}</h2>
                        <div class="space-y-2 text-lg text-gray-700 dark:text-gray-300">
                            <p><strong class="text-purple-600">Author:</strong> {{ $book->author }}</p>
                            <p><strong class="text-purple-600">Category:</strong> {{ $book->category->name }}</p>
                            <p><strong class="text-purple-600">Published Year:</strong> {{ $book->publish_year }}</p>
                            <p><strong class="text-purple-600">Description:</strong> {{ $book->description }}</p>
                            <p><strong class="text-purple-600">Available Copies:</strong> <span class="text-green-600 font-semibold">{{ $book->available_copies }}</span></p>
                            <p><strong class="text-purple-600">Price:</strong> <span class="text-yellow-600 font-semibold">{{ $book->price }} EGP</span></p>
                        </div>

                        <div class="d-flex justify-content-center md:justify-start gap-4 mt-6 flex-col md:flex-row">
                            @auth
                                <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="mb-2 md:mb-0">
                                    @csrf
                                    <button type="submit" class="btn-borrow btn-lg px-6 py-3 rounded-xl text-white font-bold transform transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                        Borrow Now
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn-login btn-lg px-6 py-3 rounded-xl text-white font-bold transform transition-all duration-300 hover:scale-110 hover:shadow-lg">
                                    Login to Borrow
                                </a>
                            @endauth

                            <a href="{{ route('books.index') }}" class="btn-back btn-lg px-6 py-3 rounded-xl text-white font-bold transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                                Back to Books
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .full-page {
            padding: 20px;
            position: relative; /* عشان الـ Navbar يظهر فوق */
            z-index: 1; /* تأكد إن الـ Navbar فوق الخلفية */
        }
        .book-card {
            border: 1px solid #e0d7f0;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .card-body p {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        .btn-lg {
            min-width: 150px;
            transition: all 0.3s ease;
        }
        .btn-borrow {
            background: linear-gradient(45deg, #9b30ff, #ff7afc);
        }
        .btn-borrow:hover {
            background: linear-gradient(45deg, #ff7afc, #9b30ff);
            box-shadow: 0 10px 20px rgba(155, 48, 255, 0.4);
        }
        .btn-login {
            background: linear-gradient(45deg, #0072ff, #00c6ff);
        }
        .btn-login:hover {
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            box-shadow: 0 10px 20px rgba(0, 114, 255, 0.4);
        }
        .btn-back {
            background: #8c7fbf;
        }
        .btn-back:hover {
            background: #aaa0c4;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        @media (max-width: 768px) {
            .book-card {
                max-width: 100%;
                padding: 15px;
            }
            .col-md-5, .col-md-7 {
                flex: 0 0 100%;
            }
            .btn-lg {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>

    <!-- JS Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.book-card');
            card.classList.add('animate__fadeInUp');
            const buttons = document.querySelectorAll('.btn-lg');
            buttons.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.add('animate__pulse');
                    setTimeout(() => this.classList.remove('animate__pulse'), 500);
                });
            });
        });
    </script>
</x-app-layout>








