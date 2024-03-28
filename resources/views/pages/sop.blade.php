@extends('layouts.app')

@section('title')
SOP
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
                    <input type="text" id="keyword" name="keyword" placeholder="Search SOP"
                        class="w-10/12 md:px-4 md:py-3 px-2 py-1 bg-transparent border rounded-md focus:outline-none focus:border">
                    <button type="submit" id="searchBtn"
                        class="w-2/12 px-4 py-2 bg-primary rounded-md text-white text-lg"><i class="fa-solid fa-magnifying-glass md:hidden"></i><span class="md:block hidden">Search</span></button>
                </form>
            </div>
        </div>
    </div>

    <div class="md:px-40 px-8 mb-20 -translate-y-16">
        <div class="grid md:grid-cols-6 grid-cols-2 gap-4 sop-container">
            @forelse ($data as $item)
            <a href="{{ Storage::url($item->file) }}" target="_blank">
                <div class="w-full md:h-40 h-32 bg-gray-200 p-4 flex justify-center items-center rounded-md">
                    <i class="fa-solid fa-download text-4xl"></i>
                </div>
                <div class="text-center mt-2 text-gray-500 truncate transition" onmouseover="removeTruncate(this)" onmouseout="addTruncate(this)">
                    {{ $item->name }}
                </div>
            </a>
            @empty

            @endforelse
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchBtn').addEventListener('click', function() {
            // Ambil nilai keyword pencarian
            var keyword = document.getElementById('keyword').value;

            // Lakukan permintaan AJAX untuk pencarian
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/sop?keyword=' + encodeURIComponent(keyword), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update konten hasil pencarian
                        document.querySelector('.sop-container').innerHTML = xhr.responseText;
                    } else {
                        console.error('Gagal melakukan permintaan pencarian');
                    }
                }
            };
            xhr.send();
        });
    });
</script>

<script>
    function removeTruncate(element) {
        element.classList.remove('truncate');
    }
    function addTruncate(element) {
        element.classList.add('truncate');
    }
</script>
@endpush