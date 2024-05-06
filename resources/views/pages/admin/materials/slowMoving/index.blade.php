@extends('layouts.admin')

@section('title')
Dashboard - Materials
@endsection

@section('content')
<div class="bg-white p-8 rounded-md text-gray-500">
    <div class="flex flex-row gap-6 justify-between">
        <a href="{{ route('create-materials') }}" class="px-6 py-3 bg-primary rounded-md text-white">
            Tambah Material
        </a>

        <div class="flex flex-row gap-4">
            <a href="{{ route('export-materials') }}" class="px-6 py-3 bg-yellow-500 rounded-md text-white">
                Export Excel
            </a>
            <a href="{{ route('index-import-materials') }}" class="px-6 py-3 bg-green-500 rounded-md text-white">
                Import Excel
            </a>
        </div>
    </div>

    <div class="mt-8 font-semibold">
        Data Material - Critical
    </div>

    <div class="pt-4">
        <table id="materialTable" class="w-full">
            <thead class="text-left">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">
                        No</th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-6/12">
                        Nama Material</th>
                    <th scope="col"
                        class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">
                        Action
                    </th>
                    <th scope="col">
                        <button class="bg-red-500 text-white rounded-md px-4 py-1 text-sm" type="button"
                            id="deleteSelected">Delete Selected</button>
                    </th>
                </tr>
            </thead>
        </table>

        <form id="deleteForm" action="{{ route('materials.delete-selected') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
            <input type="hidden" name="selectedIds[]" value="">
            <button type="submit" class="bg-red-500 text-white rounded-md px-4 py-1 text-sm" id="deleteSelected">Delete Selected</button>
        </form>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    $(document).ready(function() {
            $('#materialTable').DataTable({
                processing: true,
                pageLength: 100,
                ajax: "{{ route('get-data-slow-moving') }}",
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
                        data: 'id',
                        render: function(data) {
                            let editUrl = '{{ route('edit-material', ':id') }}';
                            let deleteUrl = '{{ route('delete-materials', ':id') }}';
                            editUrl = editUrl.replace(':id', data);
                            deleteUrl = deleteUrl.replace(':id', data);
                            return '<div class="flex">' +
                                '<a href="' + editUrl +
                                '" class="bg-yellow-500 px-3 text-sm py-1 rounded-md text-white mr-2" data-id="' +
                                data + '">Edit</a>' +
                                '<form action="' + deleteUrl + '" method="POST" class="d-inline">' +
                                '@csrf' +
                                '@method('DELETE')' +
                                '<button class="bg-red-500 text-white px-3 text-sm py-1 rounded-md" onclick="return confirm(\'Yakin ingin menghapus data?\')" type="submit">Delete</button>' +
                                '</form>' +
                                '</div>';
                        }
                    },
                    {data: 'id', render: function(data) {
                        return '<input type="checkbox" class="checkbox w-5 h-5 border-gray-300" value="' + data + '" />'
                    }},
                ]
            });

            $('#deleteSelected').on('click', function() {
                let selectedCheckbox = [];
                $('input.checkbox:checked').each(function() {
                    selectedCheckbox.push($(this).val());
                });

                if (selectedCheckbox.length === 0) {
                    alert('Tidak ada item yang dipilih untuk dihapus.');
                } else {
                    if(confirm("Are you sure you want to Delete this data?"))
                        {
                            $('#deleteForm input[name="selectedIds[]"]').val(selectedCheckbox);
                            $('#deleteForm').submit();
                        }
                }
            });
        });
</script>

@endpush
