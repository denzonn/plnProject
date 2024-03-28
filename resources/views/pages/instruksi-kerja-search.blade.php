@extends('layouts.app')

@section('title')
Instruksi Kerja
@endsection

@section('content')
<div>
    <div class="h-[40vh] pt-16 z-10">
        <img src="{{ asset('background.jpg') }}" alt="" class="w-full h-[40vh] object-cover z-10">
    </div>
    <div class="px-40 pt-32 -translate-y-1/2">
        <div class="p-8 w-full rounded-md bg-white shadow-md">
            <div class="w-full rounded-md">
                <form id="searchForm" class="flex flex-row gap-2">
                    <input type="text" id="keyword" name="keyword" placeholder="Search Work Instruction"
                        class="w-10/12 px-4 p-3 bg-transparent border rounded-md focus:outline-none focus:border">
                    <button type="submit" id="searchBtn"
                        class="w-2/12 px-4 py-2 bg-primary rounded-md text-white text-lg">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="px-40 mb-20 -translate-y-16">
        <div class="grid grid-cols-6 gap-4">
            @forelse ($ik as $item)
            <a href="{{ Storage::url($item->file) }}" target="_blank">
                <div class="w-full h-40 bg-gray-200 p-4 flex justify-center items-center rounded-md">
                    <i class="fa-solid fa-download text-4xl"></i>
                </div>
                <div class="text-center mt-2 text-gray-500 truncate transition" onmouseover="removeTruncate(this)"
                    onmouseout="addTruncate(this)">
                    {{ $item->name }}
                </div>
            </a>
            @empty
            <div class="w-full flex flex-col justify-center items-center gap-4 mt-8 col-span-full">
                <img src="{{ asset('no_data.svg') }}" alt="" class="mx-auto w-52">
                <div>Tidak ada Data</div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    function removeTruncate(element) {
        element.classList.remove('truncate');
    }
    function addTruncate(element) {
        element.classList.add('truncate');
    }
</script>
@endpush