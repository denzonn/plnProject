<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')

    <title>
        @yield('title')
    </title>
</head>

<body class="bg-white">
    @include('includes.navbar')

    @yield('content')

    <x-notify::notify />
    @notifyJs

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
    <script src="{{ asset('build/assets/app-mqEmiGqA.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
        integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>