@extends('layouts.app')

@section('title')
PLN Indonesia Power
@endsection

@section('content')
<div class="pt-16 w-full relative bg-white">
    <div
        class="absolute top-16 left-0 w-full h-[87vh] bg-gradient-to-r from-primary via-primary/95 to-transparent z-10">
    </div>
    <img src="{{ asset('background.jpg') }}" alt="" class="w-full h-[87vh] object-cover">

    <div
        class="absolute top-16 z-40 md:left-20 left-1/2 md:-translate-x-0 -translate-x-1/2 md:grid md:grid-cols-2 gap-2 md:w-[90vw] w-full ">
        <div class="pt-28 flex flex-col justify-center items-center md:block">
            <div class="text-secondary md:text-7xl text-5xl font-semibold md:text-left text-center">PLTG TELLO</div>
            <div class="md:text-3xl text-xl text-white tracking-wider text-center md:text-left">Pembangkit Listrik
                Tenaga Gas <br> Database Equipment Local
                PLTG</div>
            <div class="mt-8 mx-auto">
                @guest
                <a href="/login"
                class="md:px-40 px-20 py-3 rounded-md bg-white text-primary font-semibold  items-center justify-center text-lg"><i
                    class="fa-solid fa-right-to-bracket"></i> Login</a>
                @endguest
            </div>
            <div class="mt-20 text-white text-lg text-center md:text-left">Application by Simplifying Local Data
                Processing in the PLTG Tello
                Area</div>
            <div class="mt-2">
                <img src="{{ asset('logo_akhlak.png') }}" alt="" class="md:w-48 w-36 h-auto">
            </div>
        </div>
        <div class="md:flex hidden">
            <img src="{{ asset('phone.png') }}" alt="" class="w-[43vw]">
        </div>
    </div>
    <div class="relative h-6 bg-secondary z-40">
    </div>
</div>
@endsection