@extends('layouts.admin')

@section('title')
Create Material
@endsection

@section('content')
<div class="bg-white p-8 rounded-md text-gray-500">
    <div class="text-xl font-semibold">Edit Material - {{ $materials->name }}</div>
    <div>
        <form action="{{ route('update-materials', $materials->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Nama Material</label>
                    <input type="text" placeholder="Masukkan Nama Material" name="name"
                        class="w-full border px-4 py-3 rounded-md bg-transparent" value="{{ $materials->name }}"
                        required />
                </div>

                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Jenis Material</label>
                    <select class="select select-bordered w-full bg-transparent" name="materials_type_id">
                        @foreach ($type as $item)
                        <option value={{ $item->id }} {{ $item->id == $materials->materials_type_id ? 'selected' : ''
                            }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 ">
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Stok Material Baru</label>
                    <input type="number" placeholder="Masukkan Stock Material Baru" name="new_stock"
                        class="w-full border px-4 py-2 rounded-md bg-transparent" value="{{ $materials->new_stock }}"
                        required />
                </div>
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Stok Material Bekas</label>
                    <input type="number" placeholder="Masukkan Stock Material Bekas" name="used_stock"
                        class="w-full border px-4 py-2 rounded-md bg-transparent" value="{{ $materials->used_stock }}"
                        required />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 ">
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Tanggal Penempatan Terakhir</label>
                    <input type="date" name="last_placement_date"
                        class="w-full border px-4 py-2 rounded-md bg-transparent"
                        value="{{ $materials->last_placement_date }}" required />
                </div>
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Link Pembelian</label>
                    <input type="text" placeholder="Masukkan Link Pembelian" name="purchase_link"
                        class="w-full border px-4 py-2 rounded-md bg-transparent "
                        value="{{ $materials->purchase_link }}" required />
                </div>
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Gambar <span class="text-[10px] text-red-500">*Tidak perlu upload kalau tidak ingin
                            mengganti</span></label>
                    <input type="file" name="photos[]" class="w-full border px-4 py-2 rounded-md bg-transparent "
                        accept=".jpg, .jpeg, .png" multiple />
                </div>
            </div>
            <div class="grid grid-cols-5 gap-4 mt-4">
                <div>Material Photo :</div>
                <div class="col-span-4">
                    <div class="grid grid-cols-4 gap-4">
                        @forelse ($materials_image as $item)
                    <img src="{{ Storage::url($item->file) }}" alt="" class="w-full h-44 object-cover">
                    @empty
                        <div class="col-span-full text-red-500">No Image!!</div>
                    @endforelse
                    </div>
                </div>
            </div>
            <div class="mt-6 flex flex-col gap-2">
                <label for="">Spesifikasi</label>
                <textarea name="spesification" id="spesification" cols="30" rows="10"
                    class="form-control">{{ $materials->spesification }}</textarea>
            </div>
            <button type="submit" class="w-full rounded-md bg-primary mt-8 text-white py-2 text-lg">Update
                Material</button>
        </form>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    ClassicEditor
        .create(document.querySelector('#spesification'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush