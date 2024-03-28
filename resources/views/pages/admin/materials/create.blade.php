@extends('layouts.admin')

@section('title')
Create Material
@endsection

@section('content')
<div class="bg-white p-8 rounded-md text-gray-500">
    <div class="text-xl font-semibold">Tambahkan Material</div>
    <div>
        <form action="{{ route('store-materials') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Nama Material</label>
                    <input type="text" placeholder="Masukkan Nama Material" name="name" class="w-full border px-4 py-3 rounded-md bg-transparent" required />
                </div>

                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Jenis Material</label>
                    <select class="select select-bordered w-full bg-transparent" name="materials_type_id">
                        <option disabled selected>Pilih Jenis Material</option>
                        @foreach ($type as $item)
                        <option value={{ $item->id }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 ">
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Stok Material Baru</label>
                    <input type="number" placeholder="Masukkan Stock Material Baru" name="new_stock" class="w-full border px-4 py-2 rounded-md bg-transparent" required />
                </div>
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Stok Material Bekas</label>
                    <input type="number" placeholder="Masukkan Stock Material Bekas" name="used_stock" class="w-full border px-4 py-2 rounded-md bg-transparent" required />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 ">
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Tanggal Penempatan Terakhir</label>
                    <input type="date" name="last_placement_date" class="w-full border px-4 py-2 rounded-md bg-transparent" required />
                </div>
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Link Pembelian</label>
                    <input type="text" placeholder="Masukkan Link Pembelian" name="purchase_link" class="w-full border px-4 py-2 rounded-md bg-transparent " required />
                </div>
                <div class="mt-6 flex flex-col gap-2">
                    <label for="">Gambar</label>
                    <input type="file" name="photos[]" class="w-full border px-4 py-2 rounded-md bg-transparent " accept=".jpg, .jpeg, .png" multiple required />
                </div>
            </div>
            <div class="mt-6 flex flex-col gap-2">
                <label for="">Spesifikasi</label>
                <textarea name="spesification" id="spesification" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="w-full rounded-md bg-primary mt-8 text-white py-2 text-lg">Tambah Material</button>
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
