@extends('layouts.admin')

@section('title')
    Dashboard - Import Excel Material
@endsection

@section('content')
    <div class="bg-white p-8 rounded-md text-gray-500">
        <div class="text-xl font-semibold mb-4">Import Excel Materials</div>
        <div class="text-red-500 mb-4 font-semibold">Silahkan download contoh excelnya dan gunakan format tersebut !!!</div>
        <a href="{{ asset('example excel.xlsx') }}" class="px-6 py-3 bg-green-500 rounded-md text-white">Download Contoh Excel</a>
        <form action="{{ route('import-materials') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-8 mt-8">
            @csrf
            <input type="file" name="file" class="w-full border px-4 py-2 rounded-md bg-transparent" accept=".xlsx, .xls">
            <button type="submit" class="px-6 py-3 bg-primary rounded-md text-white w-1/2">Import Excel</button>
        </form>
    </div>
@endsection