<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#f8f5f0] to-[#e6e0f8] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white/90 p-10 rounded-2xl shadow-xl backdrop-blur-md animate-fade-in">
            <div>
                <h2 class="mt-2 text-center text-3xl font-extrabold text-purple-700 animate-bounce">
                    Admin Login
                </h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

           <form method="POST" action="{{ route('admin.login.process') }}" class="mt-8 space-y-6">
    @csrf
    <!-- Email -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" />
    </div>
    <!-- Password -->
    <div>
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" />
    </div>
    <!-- Remember Me & Forgot Password -->
    <div class="flex items-center justify-between">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
        <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-800">{{ __('Forgot your password?') }}</a>
    </div>
    <!-- Submit Button -->
    <div>
        <button type="submit" class="w-full px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg shadow-md transition-transform transform hover:scale-105">
            {{ __('Log in') }}
        </button>
    </div>
</form>
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
</x-guest-layout>