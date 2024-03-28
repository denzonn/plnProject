{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-DB-ZkGCq.css') }}">
    <script src="{{ asset('build/assets/app-mqEmiGqA.js') }}"></script>

</head>

<body>
    <div class="images grid grid-cols-2 px-32 relative">
        <div class="absolute top-0 left-0 w-screen h-screen bg-black/20"></div>
        <div class="my-auto text-center z-50 text-white drop-shadow-md">
            <div class="text-6xl font-semibold">Selamat Datang!</div>
            <div class="text-lg font-thin">@Official Websitre Pembangkit Listrik Tenaga <br> Gas Database Equipment
                Local PLTG</div>
        </div>
        <div class="my-auto mx-auto z-50 w-2/3 shadow-md">
            <div class="bg-white rounded-lg px-6 py-8">
                <div class="text-2xl font-semibold mb-4 text-primary">Sign In</div>
                <div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email"
                            class="w-full px-4 py-2 text-sm border rounded-md mb-4 bg-gray-200 text-gray-600 focus:outline-none @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') }}" autocomplete="email" autofocus required>

                        @error('email')
                        <span class="invalid-feedback text-red-500 mb-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="password" name="password"
                            class="w-full px-4 py-2 text-sm border rounded-md mb-8 bg-gray-200 text-gray-600 focus:outline-none @error('password') is-invalid @enderror"
                            placeholder="Password" autocomplete="current-password" required>

                        @error('password')
                        <span class="invalid-feedback  text-red-500  mb-4" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <button type="submit" class="bg-primary text-white w-full px-4 py-2 rounded-md">Sign
                            In</button>

                        <div class="mt-4">
                            <div class="flex flex-row gap-2 items-center justify-center">
                                <div class="text-gray-400">Powered by :</div>
                                <img src="{{ asset('logo_pln.png') }}" alt="" class="h-8">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>