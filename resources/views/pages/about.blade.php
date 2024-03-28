@extends('layouts.app')

@section('title')
    About Company
@endsection

@push('addon-style')
<link href="lightbox/lightbox.min.css" rel="stylesheet">
<script src="lightbox/lightbox.min.js"></script>
@endpush

@section('content')
    <div class="pt-20" >
        <a href="{{ asset('about.png') }}" data-lightbox="gallery">
            <img src="{{ asset('about.png') }}" alt="">
        </a>
    </div>
@endsection