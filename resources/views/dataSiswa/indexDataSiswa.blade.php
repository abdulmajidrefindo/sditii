@extends('adminlte::page')

{{-- @section('title', 'Data Siswa') --}}

@section('content_header')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vendor/adminlte/dist/css/adminlte.min.css">
    {{-- <link rel="stylesheet" href="dist/css/styleIndex.css"> --}}

    {{-- <div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0">Data Siswa</h1>
  </div>
  <div class="col-sm-6"> --}}
    {{-- <ol class="breadcrumb float-sm-right">
      {{ Breadcrumbs::render('merek') }}
    </ol> --}}
    {{-- </div>
    </div> --}}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-0 bg-gradient-green">
                        {{-- Tab Controller --}}
                        <ul class="nav nav-tabs" id="siswaTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-siswa-table" data-toggle="tab"
                                    href="#content-tab-siswa-table" role="tab" aria-controls="content-tab-siswa-table"
                                    aria-selected="true">Data Siswa</a>
                            </li>
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tab-siswa-add" data-toggle="tab"
                                        href="#content-tab-siswa-add" role="tab" aria-controls="content-tab-siswa-add"
                                        aria-selected="false">Tambah Siswa</a>
                                </li>
                            @endif
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="siswaTabContent">
                            {{-- -----------------tab add siswa----------------- --}}
                            <div class="tab-pane active show" id="content-tab-siswa-table" role="tabpanel"
                                aria-labelledby="controller-tab-siswa-table">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <form method="post" id="form_kelas">
                                                @csrf
                                                <label for="kelas">Pilih Kelas</label>
                                                <div class="input-group">
                                                    <select class="custom-select" name="kelas_id" id="kelas_id">
                                                        <option selected disabled>-Kelas-</option>
                                                        @foreach ($kelas as $k)
                                                            <option value={{ $k->id }}>{{ $k->nama_kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <div class="input-group-append">
                                                        <x-adminlte-button type="submit" class="btn bg-purple d-inline"
                                                            icon="fas fa fa-fw fa-save" label="Pilih" />
                                                    </div> --}}
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <table id="tabel-siswa" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NISN</th>
                                            <th>Orang Tua/Wali</th>
                                            <th>Kelas</th>
                                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            {{-- -----------------end tab add siswa----------------- --}}
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                {{-- -----------------tab add siswa----------------- --}}
                                <div class="tab-pane fade" id="content-tab-siswa-add" role="tabpanel"
                                    aria-labelledby="controller-tab-siswa-add">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bs-stepper-content">
                                                    <form id="form_tambah_siswa">
                                                        @csrf
                                                        {{-- Input NISN --}}
                                                        <div class="form-group">
                                                            <label for="nisn">NISN</label>
                                                            <input type="text"
                                                                class="form-control @error('nisn') is-invalid @enderror"
                                                                id="nisn" name="nisn" placeholder="Masukkan NISN">
                                                            @error('nisn')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{-- Input Nama Siswa --}}
                                                        <div class="form-group">
                                                            <label for="nama_siswa">Nama Siswa</label>
                                                            <input type="text"
                                                                class="form-control @error('nama_siswa') is-invalid @enderror"
                                                                id="nama_siswa" name="nama_siswa"
                                                                placeholder="Masukkan Nama Siswa">
                                                            @error('nama_siswa')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{-- Orang Tua/Wali --}}
                                                        <div class="form-group">
                                                            <label for="orangtua_wali">Orang Tua/Wali</label>
                                                            <input type="text"
                                                                class="form-control @error('orangtua_wali') is-invalid @enderror"
                                                                id="orangtua_wali" name="orangtua_wali"
                                                                placeholder="Masukkan Nama Orang Tua/Wali">
                                                            @error('orangtua_wali')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{-- Input Kelas --}}
                                                        <div class="form-group">
                                                            <label for="kelas">Kelas</label>
                                                            <select
                                                                class="form-control select2bs4 @error('kelas') is-invalid @enderror"
                                                                id="kelas" name="kelas" style="width: 100%;">
                                                                <option value="" selected disabled>Pilih Kelas
                                                                </option>
                                                                @foreach ($kelas as $item)
                                                                    {{-- except id 1 --}}
                                                                    
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nama_kelas }}
                                                                    
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('kelas')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{-- Simpan --}}
                                                        <x-adminlte-button type="submit"
                                                            class="btn bg-gradient-green col-12 simpan"
                                                            icon="fas fa fa-fw fa-save" label="Simpan Data" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- -----------------end tab add siswa----------------- --}}
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('head_js')
    <!-- jQuery -->
    {{-- <script type="text/javascript"  src={{ asset('vendor/jquery/jquery.min.js') }}></script> --}}

    <!-- Bootstrap 4 -->
    <script type="text/javascript" src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- DataTables  & Plugins -->
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script> --}}
    <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}>
    </script>
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/jszip/jszip.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js') }}></script> --}}
    <script src={{ asset('public/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js') }}></script>
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}></script> --}}
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script> --}}
    {{-- sendiri, versi lama --}}{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
    {{-- sendiri --}}{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script> --}}

    <!-- AdminLTE App -->
    {{-- <script src="vendor/adminlte/dist/js/adminlte.min.js"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src={{ asset('public/AdminLTE-3.2.0/dist/js/demo.js') }}></script> --}}
    <!-- Page specific script -->
@stop
@section('js')
    <script>
        $(document).ready(function() {
            //set csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function resetForm() {
            $('#form_tambah_siswa').reset();
            $('#form_tambah_siswa').find('.is-invalid').removeClass('is-invalid');
            $('#form_tambah_siswa').find('.error').remove();
        }
    </script>
    <script>
        $(document).ready(function() {
            //DataTable
            $("#tabel-siswa").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                processing: true,
                serverSide: true,
                width: '100%',
                ajax: {
                    url: "{{ route('siswa.getTable') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        sClass: 'text-center',
                        width: '5%'
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'orangtua_wali',
                        name: 'orangtua_wali'
                    },
                    {
                        data: 'nama_kelas',
                        name: 'kelas'
                    },
                    @if (Auth::user()->role->contains('role', 'Administrator'))
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            sClass: 'text-center',
                            width: '25%',
                        }
                    @endif
                ]
            }).buttons().container().appendTo('#tabel-siswa_wrapper .col-md-6:eq(0)');
            //Initialize Select2 Elements
        });
    </script>

    <script>
        //onchange kelas
        $(document).ready(function() {
            $('#kelas_id').on('change', function() {
                let id = $(this).val();
                $('#tabel-siswa').DataTable().destroy();
                $('#tabel-siswa').DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    processing: true,
                    serverSide: true,
                    width: '100%',
                    ajax: {
                        url: "{{ route('siswa.getTable') }}",
                        type: 'GET',
                        data: {
                            kelas_id: id
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id',
                            sClass: 'text-center',
                            width: '5%'
                        },
                        {
                            data: 'nama_siswa',
                            name: 'nama_siswa'
                        },
                        {
                            data: 'nisn',
                            name: 'nisn'
                        },
                        {
                            data: 'orangtua_wali',
                            name: 'orangtua_wali'
                        },
                        {
                            data: 'nama_kelas',
                            name: 'kelas'
                        },
                        @if (Auth::user()->role->contains('role', 'Administrator'))
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false,
                                sClass: 'text-center',
                                width: '25%',
                            }
                        @endif
                    ]
                }).buttons().container().appendTo('#tabel-siswa_wrapper .col-md-6:eq(0)');
            });
        });
    </script>

    {{-- ajax tambah siswa --}}
    <script>
        $(document).ready(function() {
            //tambah siswa
            $('#form_tambah_siswa').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('dataSiswa.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan!',
                            icon: 'success',
                            iconColor: '#fff',
                            toast: true,
                            background: '#45FFCA',
                            position: 'top-center',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        $('#tabel-siswa').DataTable().ajax.reload();
                        $('#content-tab-siswa-table').addClass('active show');
                        $('#content-tab-siswa-add').removeClass('active show');
                        $('#controller-tab-siswa-table').addClass('active');
                        $('#controller-tab-siswa-add').removeClass('active');
                        resetForm();

                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('#form_tambah_siswa').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_tambah_siswa').find('.error').remove();

                            //send error to adminlte form
                            $.each(err.responseJSON.errors, function(i, error) {
                                var el = $(document).find('[name="' + i + '"]');
                                if (el.hasClass('is-invalid')) {
                                    el.removeClass('is-invalid');
                                    el.next().remove();
                                }
                                el.addClass('is-invalid');
                                el.after($('<span class="error invalid-feedback">' +
                                    error[0] + '</span>'));
                            });
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Mohon isi data dengan benar!',
                                icon: 'error',
                                iconColor: '#fff',
                                toast: true,
                                background: '#f8bb86',
                                position: 'top-center',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        //delete via ajax
        $(document).on('click', '.delete', function() {
            let id = $(this).attr('data-id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('dataSiswa.destroy', '') }}/" + id,
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success != null) {
                                $('#tabel-siswa').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data Berhasil Dihapus',
                                    icon: 'success',
                                    iconColor: '#fff',
                                    color: '#fff',
                                    toast: true,
                                    background: '#8D72E1',
                                    position: 'top',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Data Gagal Dihapus',
                                    icon: 'error',
                                    iconColor: '#fff',
                                    toast: true,
                                    background: '#f8bb86',
                                    position: 'center-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@stop
