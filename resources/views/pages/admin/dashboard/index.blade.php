@extends('layouts.admin')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <div class="bg-white p-8 rounded-md text-gray-500">
        <div class="text-center text-4xl font-semibold mb-8 text-black">Welcome to Dashboard</div>
        <div class="w-full grid grid-cols-2 gap-8">
            <div>
                <div class="font-semibold text-xl mb-4">Jumlah Data Materials</div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#d7e3fc] rounded-md p-4 text-[#6d98ee]">
                        <div class="text-2xl font-semibold">Filter</div>
                        <div class="text-6xl font-semibold">{{ $filter }} <span class="text-lg font-medium">data</span></div>
                    </div>
                    <div class="bg-[#f9f6f2] rounded-md p-4 text-[#f3ba70]">
                        <div class="text-2xl font-semibold">Fast Moving</div>
                        <div class="text-6xl font-semibold">{{ $fastMoving }} <span class="text-lg font-medium">data</span></div>
                    </div>
                    <div class="bg-[#adf7b6] rounded-md p-4 text-[#3e9b49]">
                        <div class="text-2xl font-semibold">Slow Moving</div>
                        <div class="text-6xl font-semibold">{{ $slowMoving }} <span class="text-lg font-medium">data</span></div>
                    </div>
                    <div class="bg-[#adf7b6] rounded-md p-4 text-[#3e9b49]">
                        <div class="text-2xl font-semibold">Critical</div>
                        <div class="text-6xl font-semibold">{{ $critical }} <span class="text-lg font-medium">data</span></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="font-semibold text-xl mb-4">Jumlah Data SOP & IK</div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#daeaf6] rounded-md p-4 text-[#5baeec]">
                        <div class="text-2xl font-semibold">SOP</div>
                        <div class="text-6xl font-semibold">{{ $sop }} <span class="text-lg font-medium">data</span></div>
                    </div>
                    <div class="bg-[#daeaf6] rounded-md p-4 text-[#5baeec]">
                        <div class="text-2xl font-semibold">IK</div>
                        <div class="text-6xl font-semibold">{{ $ik }} <span class="text-lg font-medium">data</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection