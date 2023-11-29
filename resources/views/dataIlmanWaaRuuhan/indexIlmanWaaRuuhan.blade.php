@extends('adminlte::page')

{{-- @section('title', 'Ilman Waa Ruuhan') --}}

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

    <style>
        /* Style for the disabled form, disable the form when the button is clicked */
        .disabled-form {
            background-color: #e9ecef;
            pointer-events: none;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-0 bg-gradient-green">
                        <ul class="nav nav-tabs" id="doaTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-doa-table" data-toggle="tab"
                                    href="#content-tab-doa-table" role="tab" aria-controls="content-tab-doa-table"
                                    aria-selected="true">Tabel Ilman Waa Ruuhan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="doaTabContent">
                            <div class="tab-pane active show" id="content-tab-doa-table" role="tabpanel"
                                aria-labelledby="controller-tab-doa-table">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <form action="{{ url('/') }}/doa" method="post">
                                                @csrf
                                                <label for="kelas">Pilih Kelas</label>
                                                <div class="input-group">
                                                    <select class="custom-select" name="kelas_id" id="kelas_id">
                                                        <option selected disabled>-Kelas-</option>
                                                        @foreach ($data_kelas as $k)
                                                            <option value={{ $k->id }}>
                                                                {{ $k->nama_kelas }}</option>
                                                        @endforeach
                                                        <option value="">Semua Kelas</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <table id="tabel-doa" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Pencapaian</th>
                                            <th>Guru</th>
                                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                </table>
                        </div>

                        

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
</script>

<script>
    $(document).ready(function() {
        //DataTable
        $("#tabel-doa").DataTable({
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
                url: "{{ route('dataIlmanWaaRuuhan.getTable') }}",
                type: 'GET',
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    sClass: 'text-center',
                    width: '5%'
                },
                {
                    data: 'kelas.nama_kelas',
                    name: 'kelas.nama_kelas'
                },
                {
                    data: 'pencapaian',
                    name: 'pencapaian'
                },
                {
                    data: 'guru.nama_guru',
                    name: 'guru.nama_guru'
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
        }).buttons().container().appendTo('#tabel-doa_wrapper .col-md-6:eq(0)');
        //Initialize Select2 Elements
    });
</script>

<script>
    //onchange kelas
    $(document).ready(function() {
        $('#kelas_id').on('change', function() {
            let id = $(this).val();
            $('#tabel-doa').DataTable().destroy();
            $('#tabel-doa').DataTable({
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
                    url: "{{ route('dataIlmanWaaRuuhan.getTable') }}",
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
                    data: 'kelas.nama_kelas',
                    name: 'kelas.nama_kelas'
                },
                {
                    data: 'pencapaian',
                    name: 'pencapaian'
                },
                {
                    data: 'guru.nama_guru',
                    name: 'guru.nama_guru'
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

<script>
    $(document).on('click', '.delete-doa', function() {
        //get the parent div
        var parent = $(this).parent().parent();
        //get the parent name
        var parent_input = parent.find('input');
        let doa_id = $(this).attr('data-id');
        //disable the input by add disabled-form class
        parent_input.addClass('disabled-form');
        //change the input name
        parent_input.attr('name', 'delete_' + doa_id);
        // change the button to cancel
        $(this).html('Batal');
        $(this).removeClass('delete-doa');
        $(this).addClass('cancel-delete-doa');
        $(this).removeClass('bg-red');
        $(this).addClass('bg-secondary');
    });

    $(document).on('click', '.cancel-delete-doa', function() {
        //get the parent div
        var parent = $(this).parent().parent();
        //get the parent name
        var parent_input = parent.find('input');
        let doa_id = $(this).attr('data-id');
        //enable the input
        parent_input.removeClass('disabled-form');
        //change the input name
        parent_input.attr('name', 'doa_' + doa_id);
        // change the button to cancel
        $(this).html('Hapus');
        $(this).removeClass('cancel-delete-doa');
        $(this).addClass('delete-doa');
        $(this).addClass('bg-red');
    });
</script>
@stop
