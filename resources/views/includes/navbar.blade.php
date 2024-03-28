<nav class="fixed bg-white h-16 w-full flex flex-row justify-between gap-2 items-center md:px-20 px-4 z-50 shadow">
    <div class="flex flex-row gap-4 items-center justify-between">
        <div>
            <img src="{{ asset('logo_pln.png') }}" alt="" class="w-28 h-auto">
        </div>
        <div class="hidden pl-10 text-xs md:flex md:flex-row gap-4">
            <a href="/" class="bg-primary px-4 py-2 rounded-[4px] text-white">HOME</a>
            <a href="/materials" class="bg-primary px-4 py-2 rounded-[4px] text-white">MATERIALS</a>
            <a href="/sop" class="bg-primary px-4 py-2 rounded-[4px] text-white">SOP</a>
            <a href="/instruksi-kerja" class="bg-primary px-4 py-2 rounded-[4px] text-white">IK</a>
            <a href="/about" class="bg-primary px-4 py-2 rounded-[4px] text-white">ABOUT</a>
            {{-- <a href="" class="bg-primary px-4 py-2 rounded-[4px] text-white">HELP</a> --}}
        </div>
    </div>
    <div class="relative md:hidden flex flex-col items-center justify-between py-4 px-4 text-white">
        <!-- Tombol untuk menu burger -->
        <button id="menu-toggle" class="block text-black focus:outline-none lg:hidden">
            <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M3 6h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2zm0 5h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2zm0 5h18a1 1 0 0 1 0 2H3a1 1 0 0 1 0-2z"/>
            </svg>
        </button>
        <!-- Daftar menu -->
        <ul id="menu" class="absolute top-16 right-0 hidden lg:flex flex-col items-center gap-4 bg-white text-black text-lg px-6 py-4 space-y-4 z-50 rounded-md">
            <li><a href="/" class="hover:text-gray-400">Home</a></li>
            <li><a href="/materials" class="hover:text-gray-400">Materials</a></li>
            <li><a href="/sop" class="hover:text-gray-400">SOP</a></li>
            <a href="/instruksi-kerja" class="bg-primary px-4 py-2 rounded-[4px] text-white">IK</a>
            <li><a href="/about" class="hover:text-gray-400">About</a></li>
        </ul>
    </div>
    
    <div class="md:block hidden">
        <img src="{{ asset('logo_bumn.png') }}" alt="" class="w-28 h-auto">
    </div>
</nav>