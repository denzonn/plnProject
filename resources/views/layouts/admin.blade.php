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

<body class="bg-gray-50">
    <div class="fixed top-0 left-10 w-[20vw] h-screen pt-10 pb-16">
        <div class="bg-white w-full h-full rounded-lg p-8">
            @include('includes.sidebar')
        </div>
    </div>
    <div class="fixed bottom-4 left-10 flex flex-row gap-2 items-center">
        <img src="{{ asset('logo_pln.png') }}" alt="" class="h-7">
        <img src="{{ asset('logo_bumn.png') }}" alt="" class="h-5">
    </div>

    <div class="relative top-0 left-[25vw] py-10 h-screen w-[72vw]">
        @yield('content')
    </div>

    <x-notify::notify />
    @notifyJs

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
        integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>