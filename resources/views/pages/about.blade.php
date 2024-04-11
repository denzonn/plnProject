@extends('layouts.app')

@section('title')
    About Company
@endsection

@push('addon-style')
<link href="lightbox/lightbox.min.css" rel="stylesheet">
<script src="lightbox/lightbox.min.js"></script>
@endpush

@section('content')
    <div class="pt-20 flex flex-col gap-4 justify-center items-center" >
        <a href="{{ asset('about.png') }}" data-lightbox="gallery" clas>
            <img src="{{ asset('about.png') }}" alt="">
        </a>
        <a href="{{ asset('about2.png') }}" data-lightbox="gallery" clas>
            <img src="{{ asset('about2.png') }}" alt="" class="mt-4">
        </a>
    </div>
@endsection