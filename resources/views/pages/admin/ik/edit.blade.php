@extends('layouts.admin')

@section('title')
    Edit IK
@endsection

@section('content')
    <div class="bg-white p-8 rounded-md text-gray-500">
        <div class="text-xl font-semibold">Edit Instruksi Kerja --- {{ $data->name }}</div>
        <div>
            <form action="{{ route('update-ik', $data->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div class="mt-6 flex flex-col gap-2">
                        <label for="">Nama File</label>
                        <input type="text" placeholder="Masukkan Nama File" name="name"
                            class="w-full border px-4 py-2 rounded-md bg-transparent" value="{{ $data->name }}" required />
                    </div>
                    <div class="mt-6 flex flex-col gap-2">
                        <label for="">File <span class="text-xs text-red-500 pl-2 font-medium">*(Tidak Perlu Upload Kalau tidak ingin mengganti)</span></label>
                        <input type="file" placeholder="Masukkan Nama File" name="file"
                            class="w-full border px-4 py-2 rounded-md" accept="application/pdf"/>
                    </div>
                </div>
                <button type="submit" class="w-full rounded-md bg-primary mt-4 text-white py-2 text-lg">Edit IK</button>
            </form>
        </div>
    </div>
@endsection
