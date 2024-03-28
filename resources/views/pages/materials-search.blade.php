@extends('layouts.app')

@section('title')
Materials
@endsection

@section('content')
<div>
    <div class="md:h-[40vh] h-[25vh] pt-16 z-10">
        <img src="{{ asset('background.jpg') }}" alt="" class="w-full md:h-[40vh] h-[25vh] object-cover z-10">
    </div>
    <div class="md:px-40 px-8 pt-32 -translate-y-1/2">
        <div class="md:p-8 p-2 w-full rounded-md bg-white shadow-md">
            <div class="w-full rounded-md">
                <form id="searchForm" class="flex flex-row gap-2">
                    <input type="text" id="keyword" name="keyword" placeholder="Search Material"
                        class="w-10/12 md:px-4 md:py-3 px-2 py-1 bg-transparent border rounded-md focus:outline-none focus:border">
                    <button type="submit" id="searchBtn"
                        class="w-2/12 px-4 py-2 bg-primary rounded-md text-white text-lg"><i class="fa-solid fa-magnifying-glass md:hidden"></i><span class="md:block hidden">Search</span></button>
                </form>
            </div>
        </div>
    </div>

    <div class="md:px-40 px-8 mb-20 -translate-y-16">
        <div class="w-full grid md:grid-cols-4 grid-cols-1 gap-4 material-container">
            @forelse ($materials as $item)
            <a href="{{ route('material-detail',  $item->slug) }}" class="w-full rounded-md">
                <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->file) : '' }}"
                    alt="No Image"
                    class="{{ $item->images->isNotEmpty() ? 'w-full h-60 object-cover rounded-md' : 'bg-gray-100 border-none outline-none h-60 w-full rounded-md' }}">
                <div class="text-center mt-2 text-gray-600">{{ $item->name }}</div>
            </a>
            @empty

            @endforelse
        </div>
        @if ($materials->isEmpty())
        <div class="w-full flex flex-col justify-center items-center gap-4 mt-8">
            <img src="{{ asset('no_data.svg') }}" alt="" class="mx-auto w-52">
            <div>Tidak ada Data</div>
        </div>
        @endif
    </div>
</div>
@endsection