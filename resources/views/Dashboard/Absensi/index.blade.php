@extends('Layouts.Base')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table Absensi
                <a href="{{ route('admin.absensi.cetak') }}" class="float-end btn btn-primary">Report to PDF</a>
            </div>

            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomer Pegawai</th>
                            <th>Nama Pegawai</th>
                            <th>Divisi</th>
                            <th>Gambar</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->nomer_pegawai ?: '' }}</td>
                                <td>{{ $value->nama_lengkap ?: '' }}</td>
                                <td>{{ $value->job ?: '' }}</td>
                                <td><img src="{{ asset('assets/images/absen/' . $value->image) }}"
                                        alt="{{ $value->nama_lengkap }}" class="w-25 img-thumbnail"></td>
                                <td>{{ $value->jam_masuk ?: '' }}</td>
                                <td>{{ $value->jam_keluar ?: '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@push('custom-js')
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#table1").DataTable()
        })
    </script>
@endpush
