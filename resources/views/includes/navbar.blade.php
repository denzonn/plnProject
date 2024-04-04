<nav class="fixed bg-white h-16 w-full flex flex-row justify-between gap-2 items-center md:px-20 px-4 z-50 shadow">
    <div class="flex flex-row gap-4 items-center justify-between">
        <div>
            <img src="{{ asset('logo_pln.png') }}" alt="" class="w-28 h-auto">
        </div>
        <div class="hidden pl-10 text-xs md:flex md:flex-row gap-4">
            @auth
            <a href="/" class="bg-primary px-4 py-2 rounded-[4px] text-white">HOME</a>
            <a href="/materials" class="bg-primary px-4 py-2 rounded-[4px] text-white">MATERIALS</a>
            <a href="/sop" class="bg-primary px-4 py-2 rounded-[4px] text-white">SOP</a>
            <a href="/instruksi-kerja" class="bg-primary px-4 py-2 rounded-[4px] text-white">IK</a>
            <a href="/about" class="bg-primary px-4 py-2 rounded-[4px] text-white">ABOUT</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="bg-red-500 px-4 py-2 rounded-[4px] text-white">LOGOUT</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @endauth
            {{-- <a href="" class="bg-primary px-4 py-2 rounded-[4px] text-white">HELP</a> --}}
        </div>
    </div>
    @auth
    <div class="relative md:hidden flex flex-col items-center justify-between py-4 px-4 text-white">
        <!-- Tombol untuk menu burger -->
        <button id="menu-toggle" class="block text-black focus:outline-none lg:hidden">
            <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M3 6h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2zm0 5h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2zm0 5h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2z" />
            </svg>
        </button>
        <!-- Daftar menu -->
        <ul id="menu"
            class="absolute top-16 right-0 hidden lg:flex flex-col items-center gap-4 bg-white text-black text-lg px-6 py-4 space-y-4 z-50 rounded-md text-center">
            <li class="{{ request()->is('/*') ? 'bg-primary text-white px-3 py-1 rounded-md' : '' }}"><a href="/"
                    class="hover:text-gray-400">Home</a></li>
            <li class="{{ request()->is('materials*') ? 'bg-primary text-white px-3 py-1 rounded-md' : '' }}"><a
                    href="/materials" class="hover:text-gray-400">Materials</a></li>
            <li class="{{ request()->is('sop*') ? 'bg-primary text-white px-3 py-1 rounded-md' : '' }}"><a href="/sop"
                    class="hover:text-gray-400">SOP</a></li>
            <li class="{{ request()->is('instruksi-kerja*') ? 'bg-primary text-white px-3 py-1 rounded-md' : '' }}"><a
                    href="/instruksi-kerja" class="hover:text-gray-400">IK</a></li>
            <li class="{{ request()->is('about*') ? 'bg-primary text-white px-3 py-1 rounded-md' : '' }}"><a
                    href="/about" class="hover:text-gray-400">About</a></li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-red-500 px-4 py-2 rounded-[4px]">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    @endauth

    <div class="md:flex flex-row gap-8 hidden relative">
        @php
        $materials = App\Models\Materials::whereColumn('new_stock', '<=', 'limit_stock' )->latest()->take(3)->get();
        @endphp

            @auth
            <div class="relative">
                @if($materials->isNotEmpty())
                <div class="notification-icon"><i class="fa-solid fa-bell text-primary text-xl"></i>
                    <div class="absolute -top-1 -right-1 p-[6px] bg-red-500 rounded-full"></div>
                </div>
                @else
                <div class="notification-icon"><i class="fa-regular fa-bell text-primary text-xl"></i></div>
                @endif

                <div
                    class="popup w-64 hidden rounded-md bg-white shadow-md p-4 absolute top-12 right-0 z-50 text-center text-sm">
                    <div class="text-primary text-base font-semibold">Material Reaches the Limit</div>
                    <div class="text-right mt-1">
                        <a href="/materials">See all...</a>
                    </div>
                    <div class="space-y-3 mt-3">
                        @foreach($materials as $material)
                        <p>{{ $material->name }} - {{ $material->new_stock }} stock left</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endauth

            <img src="{{ asset('logo_bumn.png') }}" alt="" class="w-28 h-auto">
    </div>
</nav>