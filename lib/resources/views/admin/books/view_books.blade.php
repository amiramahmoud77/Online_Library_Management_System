<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 dark:text-purple-300 leading-tight animate-bounce">
            {{ __('Books Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6 bg-white/90 rounded-xl shadow-lg animate__animated animate__fadeIn">
                @foreach($books as $book)
                    <div class="card transform transition-all duration-300 hover:scale-105 hover:shadow-xl bg-white rounded-xl overflow-hidden border border-purple-100">
                        <img src="{{ Storage::url($book->photo) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                        <div class="card-body p-4 text-center">
                            <h3 class="text-lg font-semibold text-purple-800 dark:text-purple-300 mb-2">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Author:</strong> {{ $book->author }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Price:</strong> {{ $book->price }} EGP</p>
                            <p class="text-sm text-green-600 dark:text-green-400 mb-2"><strong>Available:</strong> {{ $book->available_copies }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn inline-block px-4 py-2 rounded-lg text-white font-bold bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 transition-all duration-300">
                                View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 640px) {
            .container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- JS Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
</x-app-layout>