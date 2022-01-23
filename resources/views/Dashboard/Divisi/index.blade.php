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
                Table Divisi
                <a href="javascript:;" class="btn btn-primary float-end" id="btnTambah" data-target="#crudModal">Tambah
                    Divisi</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Divisi</th>
                            <th class="w-25">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divisi as $idx => $value)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $value->job }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form method="POST"
                                                action="{{ route('admin.divisi.destroy', ['id' => $value->id]) }}"
                                                onsubmit="return confirm('Do you really want to delete the data? (ID: {{ $value->id }}  )');">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-6">
                                            <a class="btn btn-warning btn-sm editconfirm" href="javascript:void(0)"
                                                data-divisi="{{ $value->id }}">Update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form_Divisi">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Divisi</label>
                            <input type="text" class="form-control" id="job" name="job" required>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')

    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script>
        // Jquery Datatable
        $(document).ready(function() {
            $("#table1").DataTable()
        })

        $('#btnTambah').on('click', function() {
            $('#crudModalLabel').html("Tambah Dvisi")
            $('#crudModal').modal('show')
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('button.submit').on('click', function(e) {
            e.preventDefault();
            let form = $('#form_Divisi').serialize()
            $.ajax({
                url: '{{ route('admin.divisi.store') }}',
                type: 'POST',
                data: form,
                dataType: 'JSON',
                success: function() {
                    location.href = "{{ route('admin.divisi.page') }}"
                    $('#form_Divisi')[0].reset()
                }
            })
        })


        $('body').on('click', '.editconfirm', function() {
            let id = $(this).data('divisi')
            $('#crudModalLabel').html("Update Divisi")
            $('#crudModal').modal('show')
            $.get('/admin/divisi/view/' + id, function(data) {
                $('#id').val(data.id)
                $('#job').val(data.job)
            })
        })
    </script>
@endpush
