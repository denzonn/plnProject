@extends('layouts.admin')

@section('title')
    Create IK
@endsection

@section('content')
    <div class="bg-white p-8 rounded-md text-gray-500">
        <div class="text-xl font-semibold">Tambahkan Instruksi Kerja</div>
        <div>
            <form action="{{ route('store-ik') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="mt-6 flex flex-col gap-2">
                        <label for="">Nama File</label>
                        <input type="text" placeholder="Masukkan Nama File" name="name"
                            class="w-full border px-4 py-2 rounded-md bg-transparent" required/>
                    </div>
                    <div class="mt-6 flex flex-col gap-2">
                        <label for="">File</label>
                        <input type="file" placeholder="Masukkan Nama File" name="file"
                            class="w-full border px-4 py-2 rounded-md" accept="application/pdf" required/>
                    </div>
                </div>
                <button type="submit" class="w-full rounded-md bg-primary mt-4 text-white py-2 text-lg">Add IK</button>
            </form>
        </div>
    </div>
@endsection
