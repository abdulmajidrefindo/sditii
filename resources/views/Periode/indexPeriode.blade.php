@extends('adminlte::page')

{{-- @section('title', 'Tahun Pelajaran') --}}

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
        <h1 class="m-0">Data Guru</h1>
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
                    <div class="card-header p-0 pt-0">
                        <ul class="nav nav-tabs" id="periodeTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-periode-table" data-toggle="tab"
                                    href="#content-tab-periode-table" role="tab"
                                    aria-controls="content-tab-periode-table" aria-selected="true">Tabel Tahun Pelajaran</a>
                            </li>
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tab-periode-add" data-toggle="tab"
                                        href="#content-tab-periode-add" role="tab"
                                        aria-controls="content-tab-periode-add" aria-selected="false">Tambah periode</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="card-body">
                        {{-- Tab table content --}}
                        <div class="tab-content" id="periodeTabContent">
                            <div class="tab-pane active show" id="content-tab-periode-table" role="tabpanel"
                                aria-labelledby="controller-tab-periode-table">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Semester</th>
                                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    {{-- @forelse ($periode as $p)
              <tr>
                  <td>{{ $p->id }}</p>
                  <td>{{ $p->tahun_ajaran }}</p>
                  <td>{{ $p->semester }}</td>
              </tr>
              @empty
                <td>-</td>
              @endforelse --}}
                                </table>
                            </div>
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                {{-- Tab add content --}}
                                <div class="tab-pane fade" id="content-tab-periode-add" role="tabpanel"
                                    aria-labelledby="controller-tab-periode-add">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bs-stepper-content">
                                                    <form id="form_tambah_periode">
                                                        @csrf
                                                        {{-- Input Tahun Ajaran --}}
                                                        <div class="form-group">
                                                            <label for="tahun_ajaran">Tahun Ajaran</label>
                                                            <input type="text"
                                                                class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                                                id="tahun_ajaran" name="tahun_ajaran"
                                                                placeholder="Format: 2020/2021"
                                                            @error('tahun_ajaran')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{-- Input Semester --}}
                                                        <div class="form-group">
                                                            <label for="semester">Semester</label>
                                                            <select class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester">
                                                                <option value="1">Ganjil</option>
                                                                <option value="2">Genap</option>
                                                            </select>
                                                            @error('semester')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        {{-- Simpan --}}
                                                        <x-adminlte-button type="submit"
                                                            class="btn bg-purple col-12 simpan" icon="fas fa fa-fw fa-save"
                                                            label="Simpan Data" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Tab add content end --}}
                            @endif

                        </div>
                        {{-- Tab table content end --}}

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
            $('#form_tambah_periode').reset();
            $('#form_tambah_periode').find('.is-invalid').removeClass('is-invalid');
            $('#form_tambah_periode').find('.error').remove();
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
                    url: "{{ route('periode.getTable') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        sClass: 'text-center',
                        width: '5%'
                    },
                    {
                        data: 'tahun_ajaran',
                        name: 'tahun_ajaran'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
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
        });
    </script>

    {{-- ajax tambah periode --}}
    <script>
        $(document).ready(function() {
            //tambah periode
            $('#form_tambah_periode').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('dataPeriode.store') }}",
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
                        $('#example1').DataTable().ajax.reload();
                        $('#content-tab-periode-table').addClass('active show');
                        $('#content-tab-periode-add').removeClass('active show');
                        $('#controller-tab-periode-table').addClass('active');
                        $('#controller-tab-periode-add').removeClass('active');
                        resetForm();

                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('#form_tambah_periode').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_tambah_periode').find('.error').remove();

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
                        url: "{{ route('dataPeriode.index') }}" + "/" + id,
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
