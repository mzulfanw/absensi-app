@extends('Layouts.Base')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('content')
    <section class="section">

        <div class="card">
            <div class="card-header">
                Table Pegawai
                <a href="javascript:;" class="btn btn-primary float-end" id="btnTambah" data-target="#crudModal">Tambah
                    Pegawai</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kartu Pegawai</th>
                            <th> Divisi</th>
                            <th>Nama Lengkap</th>
                            <th style="width: 200px">Image</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $idx => $value)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ $value->nomer_pegawai }}</td>
                                <td>{{ $value->job }}</td>
                                <td>{{ $value->nama_lengkap }}</td>
                                <td><img src="{{ asset('/assets/images/pegawai/' . $value->image) }}"
                                        class="img-thumbnail " alt="{{ $value->nama_lengkap }}"></td>
                                <td>{{ $value->tanggal_lahir }}</td>
                                <td>{{ $value->gender }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form method="POST"
                                                action="{{ route('admin.pegawai.delete', ['id' => $value->id]) }}"
                                                onsubmit="return confirm('Do you really want to delete the data? (ID: {{ $value->id }}  )');">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm ">Delete</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-6">
                                            <a class="btn btn-warning btn-sm editconfirm" href="javascript:void(0)"
                                                data-pegawai="{{ $value->id }}">Update</a>
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
                    <form enctype="multipart/form-data" method="POST" id="form_Pegawai">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nomer Pegawai ( Required )</label>
                            <input type="number" class="form-control" id="nomerpegawai" name="nomerpegawai" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Lengkap ( Required )</label>
                            <input type="text" class="form-control" id="namalengkap" name="namalengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="image">Gambar Pegawai ( Required )</label>
                            <input type="file" class="form-control" name="gambar" id="gambar">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Gender</label>
                            <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                                <option selected>Open this select menu</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Divisi</label>
                            <select class="form-select" aria-label="Default select example" name="divisi_id"
                                id="divisi_id">
                                <option selected>Open this select menu</option>
                                @foreach ($divisi as $item)
                                    <option value="{{ $item->id }}">{{ $item->job }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        // Jquery Datatable
        $(document).ready(function() {
            $("#table1").DataTable()
        })

        $('#btnTambah').on('click', function() {
            $('#crudModalLabel').html("Tambah Pegawai")
            $('#crudModal').modal('show')
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form_Pegawai').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.pegawai.store') }}',
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    setTimeout(() => {
                        location.reload()
                    }, 3000);
                },
                complete: function() {
                    $('#form-teams')[0].reset()
                },
                error: function() {
                    alert('error')
                }
            })
        })


        $('body').on('click', '.editconfirm', function() {
            $('#crudModal').modal('show')
            $('#crudModalLabel').html('Update Pegawai')
            let id = $(this).data('pegawai')
            $.get('/admin/pegawai/view/' + id, function(data) {
                $('#id').val(data.id)
                $('#nomerpegawai').val(data.nomer_pegawai)
                $('#namalengkap').val(data.nama_lengkap)
                $('#tanggallahir').val(data.tanggal_lahir)
                $('#gender').val(data.gender)
                $('#divisi_id').val(data.divisi_id)
                $('#alamat').val(data.alamat)
            })
        })
    </script>
@endpush
