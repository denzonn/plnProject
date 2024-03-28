<div class="flex flex-col h-full justify-between text-gray-600">
    <ul class="flex flex-col gap-4 menu text-base">
        <li
            class="{{ request()->is('admin/dashboard*') ? 'bg-primary text-white' : '' }} py-2 px-6 rounded-md  hover:bg-primary hover:text-white transition">
            <a href="/admin/dashboard" class="p-0"><i class="fa-solid fa-house pr-1"></i> Dashboard</a>
        </li>
        <li>
            <details close>
                <summary
                    class="{{ request()->is('admin/sop*') ? 'bg-primary text-white' : '' }} py-2 px-6 rounded-md  hover:bg-primary hover:text-white transition p-0">
                    <div class="hover:cursor-pointer p-0"><i class="fa-solid fa-folder-open pr-1"></i>
                        SOP & IK</div></summary>
                <ul class="mt-2">
                    <li class="px-2 py-1 rounded-md hover:bg-primary hover:text-white  transition"><a href="/admin/sop" class="px-2 py-1">SOP</a></li>
                    <li class="px-2 py-1 rounded-md hover:bg-primary hover:text-white  transition"><a href="/admin/ik" class="px-2 py-1">Instruksi Kerja</a></li>
                </ul>
            </details>
        </li>
        <li>
            <details close>
                <summary
                    class="{{ request()->is('admin/materials*') ? 'bg-primary text-white' : '' }} py-2 px-6 rounded-md  hover:bg-primary hover:text-white transition p-0">
                    <div class="hover:cursor-pointer p-0"><i class="fa-solid fa-clipboard-list pr-1"></i>
                        Materials</div></summary>
                <ul class="mt-2">
                    <li class="px-2 py-1 rounded-md hover:bg-primary hover:text-white  transition"><a href="/admin/materials/filter" class="px-2 py-1">Filter</a></li>
                    <li class="px-2 py-1 rounded-md hover:bg-primary hover:text-white  transition"><a href="/admin/materials/fast-moving" class="px-2 py-1">Fast Moving</a></li>
                    <li class="px-2 py-1 rounded-md hover:bg-primary hover:text-white  transition"><a href="/admin/materials/critical" class="px-2 py-1">Critical</a></li>
                </ul>
            </details>
        </li>
    </ul>
    <div>
        <ul>
            <li class="py-2 rounded-md px-6 hover:bg-red-500 hover:text-white  transition">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fa-solid fa-right-from-bracket pr-1"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>