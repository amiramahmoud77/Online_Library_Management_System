<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-700 dark:text-purple-300 leading-tight animate-bounce">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg backdrop-blur-md animate-fade-in">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-extrabold mb-4 text-purple-700">{{ __("You're logged in!") }}</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p class="text-sm text-purple-600 mb-4"><strong>Total Borrowed Books:</strong> {{ $borrowedBooks->count() }}</p>

                    <h3 class="text-lg font-semibold mb-4 text-purple-700">Your Borrowed Books</h3>
                    @if ($borrowedBooks->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">No borrowed books yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($borrowedBooks as $borrow)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md p-4">
                                    <h4 class="text-md font-semibold text-purple-700 dark:text-purple-300 mb-2">{{ $borrow->book->name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Author:</strong> {{ $borrow->book->author }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Borrow Date:</strong> {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('Y-m-d') }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Return Date:</strong> {{ \Carbon\Carbon::parse($borrow->return_date)->format('Y-m-d') }}</p>
                                    @php
                                        $returnDate = \Carbon\Carbon::parse($borrow->return_date);
                                        $daysLeft = $returnDate->diffInDays(now(), false);
                                    @endphp
                                    @if ($daysLeft <= 2 && $daysLeft >= 0)
                                        <p class="text-yellow-600 dark:text-yellow-400 mt-1">Warning: Return due in {{ $daysLeft }} day(s)!</p>
                                    @elseif ($daysLeft < 0)
                                        <p class="text-red-600 dark:text-red-400 mt-1">Overdue by {{ abs($daysLeft) }} day(s)!</p>
                                    @endif
                                    <div class="mt-2 space-x-2">
                                        <form method="POST" action="{{ route('books.return', $borrow->book) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm hover:scale-105 transition-transform">
                                                Return
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('borrows.request-extension', $borrow->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm hover:scale-105 transition-transform">
                                                Request Extension
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</x-app-layout>
