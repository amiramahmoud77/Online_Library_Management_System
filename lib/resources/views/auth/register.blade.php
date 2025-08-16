<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#f8f5f0] to-[#e6e0f8] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8 bg-white/90 p-10 rounded-2xl shadow-xl backdrop-blur-md animate-fade-in">
            <div>
                <h2 class="mt-2 text-center text-3xl font-extrabold text-purple-700 animate-bounce">
                    Create Your Account
                </h2>
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-8 space-y-6">
                @csrf

                <!-- First Name -->
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" class="text-purple-700 font-semibold" />
                    <x-text-input id="first_name" type="text" name="first_name"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        :value="old('first_name')" required autofocus autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-red-500" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" class="text-purple-700 font-semibold" />
                    <x-text-input id="last_name" type="text" name="last_name"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        :value="old('last_name')" required autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-red-500" />
                </div>

                <!-- Address -->
                <div>
                    <x-input-label for="address" :value="__('Address')" class="text-purple-700 font-semibold" />
                    <x-text-input id="address" type="text" name="address"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        :value="old('address')" required autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2 text-red-500" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-purple-700 font-semibold" />
                    <x-text-input id="email" type="email" name="email"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('Phone')" class="text-purple-700 font-semibold" />
                    <x-text-input id="phone" type="text" name="phone"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        :value="old('phone')" required autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-500" />
                </div>

                <!-- Photo -->
                <div>
                    <x-input-label for="photo" :value="__('Photo')" class="text-purple-700 font-semibold" />
                    <x-text-input id="photo" type="file" name="photo"
                        class="mt-1 block w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                        file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200"
                        :value="old('photo')" required autocomplete="photo" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-purple-700 font-semibold" />
                    <x-text-input id="password" type="password" name="password"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-purple-700 font-semibold" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">
                        Already registered?
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg shadow-md transition-transform transform hover:scale-105">
                        Register
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