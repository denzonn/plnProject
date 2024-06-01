@extends('layouts.app')

@section('title')
    Material Detail
@endsection

@push('addon-style')
    <link href="lightbox/lightbox.min.css" rel="stylesheet">
    <script src="lightbox/lightbox.min.js"></script>
@endpush

@section('content')
    <div class="md:px-40 px-8 pt-28">
        <div class="md:grid md:grid-cols-3 flex flex-col gap-4">
            <div class="col-span-1">
                <a href="{{ $firstImage ? Storage::url($firstImage->file) : '' }}" data-lightbox="gallery">
                    <img src="{{ $firstImage ? Storage::url($firstImage->file) : '' }}" alt=""
                        class="{{ $firstImage ? '' : 'bg-gray-200 h-60 w-full' }}" alt="No Image">
                </a>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    @foreach ($otherImage as $item)
                        <a href="{{ Storage::url($item->file) }}" data-lightbox="gallery">
                            <img src="{{ Storage::url($item->file) }}" alt="" class="w-full h-24 object-cover">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-span-2 text-gray-700">
                <div class="text-2xl">{{ $data->name }}</div>
                <div class="text-gray-400 text-sm">Type : {{ $data->materials_type->name }}</div>
                <div class="flex flex-row gap-2 mt-4">
                    <div>Spesification :</div>
                    <div>{!! $data->spesification ? $data->spesification : "No Spesification" !!}</div>
                </div>
                <div class="mt-2">New Stock Units : {{ $data->new_stock }} pcs</div>
                <div class="mt-2">Used Stock Units : {{ $data->used_stock }} pcs</div>
                <div class="mt-2">Last Replacement Date :
                    {{ $data->last_replacement_date ? \Carbon\Carbon::parse($data->last_placement_date)->translatedFormat('l, d F Y') : 'No Date' }}
                </div>
                <div class="mt-2">Purchase Link : {{ $data->purchase_link ? $data->purchase_link : 'No Purchase Link' }}</div>
            </div>
        </div>

        <div class="my-20">
            <div class="mb-2 text-xl font-semibold text-gray-700">Similar Materials :</div>
            <div class="grid md:grid-cols-5 grid-cols-2 gap-4 ">
                @forelse ($similarData as $item)
                    <a href="{{ route('material-detail', $item->slug) }}" class="w-full rounded-md">
                        <img src="{{ $item->images->isNotEmpty() ? Storage::url($item->images->first()->file) : '' }}"
                            alt="No Image"
                            class="{{ $item->images->isNotEmpty() ? 'w-full md:h-60 h-40  object-cover rounded-md' : 'bg-gray-100 border-none outline-none md:h-52 h-40 w-full rounded-md' }}">
                        <div class="text-center mt-2 text-gray-600">{{ $item->name }}</div>
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
