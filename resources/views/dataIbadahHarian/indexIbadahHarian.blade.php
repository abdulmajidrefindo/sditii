@extends('adminlte::page')

{{-- @section('title', 'IbadahHarian') --}}

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
                        <ul class="nav nav-tabs" id="ibadahHarianTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-ibadah-harian-table" data-toggle="tab"
                                    href="#content-tab-ibadah-harian-table" role="tab" aria-controls="content-tab-ibadah-harian-table"
                                    aria-selected="true">Tabel Ibadah Harian</a>
                            </li>
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tambah-ibadah-harian-add" data-toggle="tab"
                                        href="#content-tambah-ibadah-harian-add" role="tab" aria-controls="content-tambah-ibadah-harian-add"
                                        aria-selected="false">Tambah Kriteria</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="ibadahHarianTabContent">
                            <div class="tab-pane active show" id="content-tab-ibadah-harian-table" role="tabpanel"
                                aria-labelledby="controller-tab-ibadah-harian-table">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <form action="{{ url('/') }}/ibadahHarian" method="post">
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

                                <table id="tabel-ibadah-harian" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Periode</th>
                                            <th>Kelas</th>
                                            <th>Kriteria</th>
                                            <th>Guru</th>
                                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                </table>
                        </div>

                        @if (Auth::user()->role->contains('role', 'Administrator'))
                            {{-- Tab add content --}}
                            <div class="tab-pane fade" id="content-tambah-ibadah-harian-add" role="tabpanel"
                                aria-labelledby="controller-tambah-ibadah-harian-add">
                                <div class="card-body">
                                    <form id="form_tambah_ibadah_harian">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="bs-stepper-content">
                                                    {{-- Input Kelas --}}
                                                    <div class="form-group">
                                                        <label for="kelas">Pilih Kelas</label>
                                                        <select class="custom-select" name="kelas_ibadah_harian_tambah"
                                                            id="kelas_ibadah_harian_tambah">
                                                            <option selected disabled>-Kelas-</option>
                                                            @foreach ($data_kelas as $k)
                                                                <option value={{ $k->id }}>{{ $k->nama_kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kelas_ibadah_harian_tambah')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="bs-stepper-content">
                                                    {{-- Input Nilai --}}
                                                    <div id="form_tambah_ibadah_harian_1">
                                                        <div class="form-group">
                                                            <label for="tambah_ibadah_harian_guru_1">Pilih Guru</label>
                                                            <select class="custom-select" name="tambah_ibadah_harian_guru_1"
                                                                id="tambah_ibadah_harian_guru_1">
                                                                <option selected disabled>-Guru-</option>
                                                                @foreach ($data_guru as $g)
                                                                    <option value={{ $g->id }}>
                                                                        {{ $g->nama_guru }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('tambah_ibadah_harian_guru_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tambah_ibadah_harian_1">Tambah Kriteria</label>
                                                            <input type="text" class="form-control"
                                                                name="tambah_ibadah_harian_1" id="tambah_ibadah_harian_1"
                                                                placeholder="Masukkan Kriteria">
                                                            @error('tambah_ibadah_harian_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div id="tambah_ibadah_harian_tambah">
                                                        {{-- Akan ditambahkan melalui ajax --}}
                                                    </div>

                                                    <div id="tambah_ibadah_harian_button">

                                                        <x-adminlte-button type="button" id="kurang_ibadah_harian"
                                                        class="btn bg-red col-12 kurang_ibadah_harian"
                                                        icon="fas fa fa-fw fa-minus" label="Hapus Kriteria"/>

                                                        <x-adminlte-button type="button" id="tambah_ibadah_harian"
                                                            class="btn-outline-secondary col-12 tambah_ibadah_harian"
                                                            icon="fas fa fa-fw fa-plus" label="Tambah Kriteria" />   
                                                        

                                                    </div>
                                                    {{-- Simpan --}}
                                                </div>

                                                <hr>
                                                <x-adminlte-button type="submit"
                                            class="btn bg-gradient-green col-12 simpan"
                                            icon="fas fa fa-fw fa-save" label="Simpan Data" />

                                            </div>
                                            
                                            
                                        

                                        </div>
                                    </form>
                                </div>

                            </div>
                            {{-- Tab add content end --}}
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
</script>

<script>
//tambah ibadah_harian
    $(document).ready(function() {
        $('#kurang_ibadah_harian').hide();
        var i = 1;
        $('#tambah_ibadah_harian').click(function() {
            i++;
            $('#tambah_ibadah_harian_tambah').append(
                '<hr id="garis' + i +
                '"> <div id="form_tambah_ibadah_harian_' + i +
                '"><div class="form-group"><label for="tambah_ibadah_harian_guru_' + i +
                '">Pilih Guru</label><select class="custom-select" name="tambah_ibadah_harian_guru_' + i +
                '" id="tambah_ibadah_harian_guru_' + i +
                '"><option selected disabled>-Guru-</option>@foreach ($data_guru as $g)<option value={{ $g->id }}>{{ $g->nama_guru }}</option>@endforeach</select>@error("tambah_ibadah_harian_guru_' +
                i +
                '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="form-group"><label for="tambah_ibadah_harian_' +
                i +
                '">Tambah Kriteria</label><input type="text" class="form-control" name="tambah_ibadah_harian_' + i +
                '" id="tambah_ibadah_harian_' + i +
                '" placeholder="Masukkan Kriteria">@error("tambah_ibadah_harian_' + i +
                '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div>'
            );
            $('#kurang_ibadah_harian').show();
        });

        $('#kurang_ibadah_harian').click(function() {
            $('#garis' + i).remove();
            $('#form_tambah_ibadah_harian_' + i).remove();
            i--;
            if (i == 1) {
                $('#kurang_ibadah_harian').hide();
            }
        });
    });
</script>

<script>
    //aler on form_tambah_ibadah_harian submit
    $(document).on('submit', '#form_tambah_ibadah_harian', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data Akan Segera Disimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!'
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('data_ibadah_harian.store') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_tambah_ibadah_harian').serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function(errors) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Data gagal disimpan!'
                        });
                        // add error messages
                        if (errors.responseJSON.errors) {
                            // delete all error messages
                            $('#form_tambah_ibadah_harian .invalid-feedback').remove();
                            $('#form_tambah_ibadah_harian select').removeClass(
                                'is-invalid');
                            $('#form_tambah_ibadah_harian input').removeClass(
                                'is-invalid');
                            
                            $.each(errors.responseJSON.errors, function(key, value) {
                                $('#form_tambah_ibadah_harian #' + key).addClass(
                                    'is-invalid');
                                $('#form_tambah_ibadah_harian #' + key).parent().find(
                                    '.invalid-feedback').remove();
                                $('#form_tambah_ibadah_harian #' + key).parent().append(
                                    '<div class="invalid-feedback">' +
                                    value + '</div>');
                            });
                        }
                    }
                });
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        //DataTable
        $("#tabel-ibadah-harian").DataTable({
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
                url: "{{ route('dataIbadahHarian.getTable') }}",
                type: 'GET',
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    sClass: 'text-center',
                    width: '5%'
                },
                {
                    data: 'periode',
                    name: 'periode'
                },
                {
                    data: 'kelas.nama_kelas',
                    name: 'kelas.nama_kelas'
                },
                {
                    data: 'nama_kriteria',
                    name: 'nama_kriteria'
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
        }).buttons().container().appendTo('#tabel-ibadah-harian_wrapper .col-md-6:eq(0)');
        //Initialize Select2 Elements
    });
</script>

<script>
    //onchange kelas
    $(document).ready(function() {
        $('#kelas_id').on('change', function() {
            let id = $(this).val();
            $('#tabel-ibadah-harian').DataTable().destroy();
            $('#tabel-ibadah-harian').DataTable({
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
                    url: "{{ route('dataIbadahHarian.getTable') }}",
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
                    data: 'periode',
                    name: 'periode'
                },
                {
                    data: 'kelas.nama_kelas',
                    name: 'kelas.nama_kelas'
                },
                {
                    data: 'nama_kriteria',
                    name: 'nama_kriteria'
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
    $(document).on('click', '.delete-ibadah-harian', function() {
        //get the parent div
        var parent = $(this).parent().parent();
        //get the parent name
        var parent_input = parent.find('input');
        let ibadah_harian_id = $(this).attr('data-id');
        //disable the input by add disabled-form class
        parent_input.addClass('disabled-form');
        //change the input name
        parent_input.attr('name', 'delete_' + ibadah_harian_id);
        // change the button to cancel
        $(this).html('Batal');
        $(this).removeClass('delete-ibadah-harian');
        $(this).addClass('cancel-delete-ibadah-harian');
        $(this).removeClass('bg-red');
        $(this).addClass('bg-secondary');
    });

    $(document).on('click', '.cancel-delete-ibadah-harian', function() {
        //get the parent div
        var parent = $(this).parent().parent();
        //get the parent name
        var parent_input = parent.find('input');
        let ibadah_harian_id = $(this).attr('data-id');
        //enable the input
        parent_input.removeClass('disabled-form');
        //change the input name
        parent_input.attr('name', 'ibadah_harian_' + ibadah_harian_id);
        // change the button to cancel
        $(this).html('Hapus');
        $(this).removeClass('cancel-delete-ibadah-harian');
        $(this).addClass('delete-ibadah-harian');
        $(this).addClass('bg-red');
    });
</script>

<script>
    //delete via ajax with sweet alert
    $(document).on('click', '.delete', function() {
        let ibadah_harian_id = $(this).attr('data-id');
        let url = '{{ route('dataIbadahHarian.destroy', ':ibadah_harian_id') }}';
        url = url.replace(':ibadah_harian_id', ibadah_harian_id);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Semua data nilai siswa akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!'
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        method: '_DELETE',
                        submit: true,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.error,
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.error,
                        });
                    }
                });
            }
        });
    });
</script>
@stop
