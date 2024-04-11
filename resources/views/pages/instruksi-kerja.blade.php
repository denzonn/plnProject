@extends('layouts.app')

@section('title')
Instruksi Kerja
@endsection

@section('content')
<div>
    <div class="md:h-[40vh] h-[25vh] pt-16 z-10">
        <img src="{{ asset('background.jpg') }}" alt="" class="w-full md:h-[40vh] h-[25vh] object-cover z-10">
    </div>
    <div class="md:px-40 px-8 pt-32 md:-translate-y-52 -translate-y-32">
        <div class="md:p-8 p-2 w-full rounded-md bg-white shadow-md">
            <div class="w-full rounded-md">
                <table id="ikTable" class="w-full text-left">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama File</th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                File
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    </div>
@endsection

@push('addon-script')
    <script>
        jQuery(document).ready(function($) {
            $('#ikTable').DataTable({
                processing: true,
                ajax: "{{ route('get-data-ik') }}",
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
                        data: 'file',
                        name: 'file',
                        render: function(data) {
                            var downloadUrl = '{{ Storage::url(':path') }}';
                            downloadUrl = downloadUrl.replace(':path', data);
                            return '<a href="' + downloadUrl + '" target="_blank">' +
                                '<button class=""><i class="fas fa-download"></i></button>' +
                                '</a>';
                        }
                    }
                ]
            })
        });
    </script>
@endpush
