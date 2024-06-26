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
                        class="w-2/12 px-4 py-2 bg-primary rounded-md text-white text-lg"><i
                            class="fa-solid fa-magnifying-glass md:hidden"></i><span
                            class="md:block hidden">Search</span></button>
                </form>
            </div>
        </div>
    </div>

    <div class="md:px-40 px-8 mb-20 -translate-y-16">
        <div class="mb-8 text-end">
            <select id="materialType"
                class="select select-bordered border-gray-300 bg-transparent w-full max-w-xs text-base">
                <option value="limit">Material Limit Stock</option>
                <option value="filter">Filter</option>
                <option value="fastMoving">Fast Moving</option>
                <option value="slowMoving">Slow Moving</option>
                <option value="critical">Critical</option>
            </select>
        </div>

        <div class="w-full grid md:grid-cols-4 grid-cols-1 gap-4 material-container" data-type="filter"
            style="display: none;">
            @forelse ($filter as $item)
            <a href="{{ route('material-detail',  $item->slug) }}" class="w-full rounded-md">
                <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->file) : '' }}"
                    alt="No Image"
                    class="{{ $item->images->isNotEmpty() ? 'w-full h-60 object-cover rounded-md' : 'bg-gray-100 border-none outline-none h-60 w-full rounded-md' }}">
                <div class="text-center mt-2 text-gray-600">{{ $item->name }}</div>
            </a>
            @empty
            <div class="w-full flex flex-col justify-center items-center gap-4 mt-8 col-span-full">
                <img src="{{ asset('no_data.svg') }}" alt="" class="mx-auto w-52">
                <div>Tidak ada Data</div>
            </div>
            @endforelse
        </div>
        <div class="w-full grid md:grid-cols-4 grid-cols-1 gap-4 material-container" data-type="fastMoving"
            style="display: none;">
            @forelse ($fastMoving as $item)
            <a href="{{ route('material-detail',  $item->slug) }}" class="w-full rounded-md">
                <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->file) : '' }}"
                    alt="No Image"
                    class="{{ $item->images->isNotEmpty() ? 'w-full h-60 object-cover rounded-md' : 'bg-gray-100 border-none outline-none h-60 w-full rounded-md' }}">
                <div class="text-center mt-2 text-gray-600">{{ $item->name }}</div>
            </a>
            @empty
            <div class="w-full flex flex-col justify-center items-center gap-4 mt-8 col-span-full">
                <img src="{{ asset('no_data.svg') }}" alt="" class="mx-auto w-52">
                <div>Tidak ada Data</div>
            </div>
            @endforelse
        </div>
        <div class="w-full grid md:grid-cols-4 grid-cols-1 gap-4 material-container" data-type="slowMoving"
            style="display: none;">
            @forelse ($slowMoving as $item)
            <a href="{{ route('material-detail',  $item->slug) }}" class="w-full rounded-md">
                <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->file) : '' }}"
                    alt="No Image"
                    class="{{ $item->images->isNotEmpty() ? 'w-full h-60 object-cover rounded-md' : 'bg-gray-100 border-none outline-none h-60 w-full rounded-md' }}">
                <div class="text-center mt-2 text-gray-600">{{ $item->name }}</div>
            </a>
            @empty
            <div class="w-full flex flex-col justify-center items-center gap-4 mt-8 col-span-full">
                <img src="{{ asset('no_data.svg') }}" alt="" class="mx-auto w-52">
                <div>Tidak ada Data</div>
            </div>
            @endforelse
        </div>
        <div class="w-full grid md:grid-cols-4 grid-cols-1 gap-4 material-container" data-type="critical"
            style="display: none;">
            @forelse ($critical as $item)
            <a href="{{ route('material-detail',  $item->slug) }}" class="w-full rounded-md">
                <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->file) : '' }}"
                    alt="No Image"
                    class="{{ $item->images->isNotEmpty() ? 'w-full h-60 object-cover rounded-md' : 'bg-gray-100 border-none outline-none h-60 w-full rounded-md' }}">
                <div class="text-center mt-2 text-gray-600">{{ $item->name }}</div>
            </a>
            @empty
            <div class="w-full flex flex-col justify-center items-center gap-4 mt-8 col-span-full">
                <img src="{{ asset('no_data.svg') }}" alt="" class="mx-auto w-52">
                <div>Tidak ada Data</div>
            </div>
            @endforelse
        </div>
        <div class="w-full material-container" data-type="limit">
            <table id="limitTable" class="w-full text-left">
                <thead>
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No</th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Material Name</th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stock
                        </th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    document.getElementById('materialType').addEventListener('change', function() {
        var type = this.value;
        var elementsToShow = document.querySelectorAll('.material-container[data-type="' + type + '"]');

        // Sembunyikan semua elemen
        document.querySelectorAll('.material-container').forEach(function(element) {
            element.style.display = 'none';
        });

        // Tampilkan elemen yang sesuai dengan opsi yang dipilih
        elementsToShow.forEach(function(element) {
            element.style.display = 'grid';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchBtn').addEventListener('click', function() {
            // Ambil nilai keyword pencarian
            var keyword = document.getElementById('keyword').value;

            // Lakukan permintaan AJAX untuk pencarian
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/materials?keyword=' + encodeURIComponent(keyword), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update konten hasil pencarian
                        document.querySelector('.material-container').innerHTML = xhr.responseText;
                    } else {
                        console.error('Gagal melakukan permintaan pencarian');
                    }
                }
            };
            xhr.send();
        });
    });
</script>
@endpush

@push('addon-script')
<script>
    jQuery(document).ready(function($) {
            $('#limitTable').DataTable({
                processing: true,
                ajax: "{{ route('get-data-limit') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'new_stock',
                        name: 'new_stock',
                        render: function(data){
                            return data + ' pcs'
                        }
                    },
                    {
                        data: 'slug',
                        render: function(data) {
                            let materialDetail = '{{ route('material-detail', ':slug') }}';
                            materialDetail = materialDetail.replace(':slug', data);
                            return '<div class="flex">' +
                                '<a href="' + materialDetail +
                                '" class="px-3 text-sm py-1 rounded-md text-white mr-2" data-id="' +
                                data + '"><i class="fa-solid fa-eye text-gray-500"></i></a>'
                        }
                    }
                ]
            })
        });
</script>
@endpush