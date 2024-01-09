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

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Data Guru</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('dataGuru') }}
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="card card-secondary card-tabs">
    <div class="card-header p-0 pt-0 bg-gradient-green">
        {{-- tab control --}}
        <ul class="nav nav-tabs" id="kategori-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="controller-tab-guru-table" data-toggle="pill"
                href="#content-tab-guru-table" role="tab" aria-controls="content-tab-guru-table"
                aria-selected="true">
                <i class="fas fa-xs fa-table fa-fw"></i>
                Daftar Guru</a>
            </li>
            @if (Auth::user()->role->contains('role', 'Administrator'))
            <li class="nav-item">
                <a class="nav-link" id="controller-tab-guru-add" data-toggle="pill" href="#content-tab-guru-add"
                role="tab" aria-controls="content-tab-guru-add" aria-selected="false">
                <i class="fas fa-xs fa-plus fa-fw"></i>
                Tambah Guru</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="controller-tab-guru-export-import" data-toggle="tab"
                href="#content-tab-guru-export-import" role="tab"
                aria-controls="content-tab-guru-export-import"
                aria-selected="false">Ekspor/Impor Data</a>
            </li>
            @endif
        </ul>
    </div>
    
    <div class="card-body">
        {{-- tab daftar --}}
        <div class="tab-content" id="guruTabContent">
            <div class="tab-pane active show" id="content-tab-guru-table" role="tabpanel"
            aria-labelledby="controller-tab-guru-table">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Kelas Perwalian</th>
                        {{-- <th>Peran</th> --}}
                        @if (Auth::user()->role->contains('role', 'Administrator'))
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
        {{-- /tab daftar --}}
        @if (Auth::user()->role->contains('role', 'Administrator'))
        {{-- tab tambah --}}
        <div class="tab-pane fade" id="content-tab-guru-add" role="tabpanel"
        aria-labelledby="controller-tab-guru-add">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="bs-stepper-content">
                        <form id="form_tambah_guru">
                            @csrf
                            <div class="form-group">
                                <label for="user" class="form-label">Akun User</label>
                                <select class="form-control @error('user') is-invalid @enderror"
                                id="user" name="user" data-placeholder="-pilih akun user-"
                                style="width: 100%;">
                                <option selected disabled>-pilih akun user-</option>
                                @foreach ($user as $u)
                                <option value={{ $u->id }}>{{ $u->name }}</option>
                                @endforeach
                                
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            
                            <div class="form-group">
                                <label for="nip" class="form-label"
                                style="margin-top: 15px">NIP</label>
                                <input type="nip"
                                class="form-control @error('nip') is-invalid @enderror"
                                name="nip" id="nip" placeholder="-masukkan NIP guru-">
                                @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <x-adminlte-button type="submit" class="btn bg-gradient-green col-12 simpan"
                            icon="fas fa fa-fw fa-save" label="Simpan Data" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- /tab tambah --}}
{{-- Tab export-import content --}}
<div class="tab-pane fade" id="content-tab-guru-export-import" role="tabpanel"
aria-labelledby="controller-tab-guru-export-import">
<div class="card-body">
    <div class="row">
        {{-- Export Data --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-gradient-green">
                    <h3 class="card-title">Ekspor Data Guru</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/') }}/dataGuru/export_excel"
                    method="post">
                    @csrf
                    <div class="form-group">
                        <label for="kelas">Ekspor File Excel</label><br>
                        <x-adminlte-button style="width: 100%" type="submit" class="btn bg-gradient-green d-inline" icon="fas fa fa-fw fa-save" label="Ekspor" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Export Data --}}
    {{-- Import Data --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-gradient-green">
                <h3 class="card-title">Impor Data Guru</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/') }}/dataGuru/import_excel" method="post"
                enctype="multipart/form-data">
                @csrf
                
                <x-adminlte-input-file name="file_nilai_excel" igroup-size="md"
                placeholder="Pilih file..." label="Pilih File Excel"
                fgroup-class="col-md-12">
                <x-slot name="appendSlot">
                    <x-adminlte-button label="Impor" type="submit"
                    class="btn bg-gradient-green" />
                </x-slot>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-green">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
        </form>
    </div>
</div>
{{-- End Import Data --}}
@endif
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
<script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
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
        $('#form_tambah_guru').reset();
        $('#form_tambah_guru').find('.is-invalid').removeClass('is-invalid');
        $('#form_tambah_guru').find('.error').remove();
    }
</script>
<script>
    $(document).ready(function() {
        //DataTable
        $("#example1").DataTable({
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
                url: "{{ route('guru.getTable') }}",
                type: 'GET',
            },
            columns: [{
                data: 'id',
                name: 'id',
                sClass: 'text-center',
                width: '5%'
            },
            {
                data: 'nama_guru',
                name: 'nama_guru'
            },
            {
                data: 'nip',
                name: 'nip'
            },
            {
                data: 'kelas',
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
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //Initialize Select2 Elements
    });
</script>

{{-- ajax tambah guru --}}
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('#controller-tab-guru-add').on('click', function() {
            $('#form_tambah_guru')[0].reset();
        });
        $('#form_tambah_guru').on('submit', function(e) {
            e.preventDefault();
            let user = $('#user').val();
            let user_name = $('#user_name').val();
            let nip = $('#nip').val();
            //let kelas = $('#kelas').val();
            $.ajax({
                type: "POST",
                url: "{{ route('dataGuru.store') }}",
                data: {
                    user: user,
                    user_name: user_name,
                    nip: nip,
                    //kelas: kelas,
                },
                dataType: "JSON",
                success: function(response) {
                    // if (response.success) {
                        $('#example1').DataTable().ajax.reload();
                        $('#form_tambah_guru')[0].reset();
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
                    },
                    error: function(err) {
                        
                        if (err.status == 422) {
                            $('#form_tambah_guru').find(".is-invalid").removeClass(
                            "is-invalid");
                            $('#form_tambah_guru').find('.error').remove();
                            
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
                            url: "{{ route('dataGuru.destroy', '') }}" + "/" + id,
                            success: function(response) {
                                if (response.success != null) {
                                    $('#example1').DataTable().ajax.reload();
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
                                        text: response.error,
                                        icon: 'error',
                                        iconColor: '#fff',
                                        toast: false,
                                        background: '#f8bb86',
                                        position: 'center',
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
        