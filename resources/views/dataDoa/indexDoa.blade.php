@extends('adminlte::page')

{{-- @section('title', 'Doa') --}}

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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Doa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('dataDoa') }}
            </ol>
        </div>
    </div>
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
                                    aria-selected="true"><i class="fas fa-m fa-table fa-fw"></i>Tabel Doa</a>
                            </li>
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tambah-doa-add" data-toggle="tab"
                                        href="#content-tambah-doa-add" role="tab" aria-controls="content-tambah-doa-add"
                                        aria-selected="false"><i class="fas fa-m fa-plus fa-fw"></i>Tambah Doa</a>
                                </li>
                            @endif
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
                                            <th>Periode</th>
                                            <th>Kelas</th>
                                            <th>Doa</th>
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
                            <div class="tab-pane fade" id="content-tambah-doa-add" role="tabpanel"
                                aria-labelledby="controller-tambah-doa-add">
                                <div class="card-body">
                                    <form id="form_tambah_doa">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="bs-stepper-content">
                                                    {{-- Input Kelas --}}
                                                    <div class="form-group">
                                                        <label for="kelas">Pilih Kelas</label>
                                                        <select class="custom-select" name="kelas_doa_tambah"
                                                            id="kelas_doa_tambah">
                                                            <option selected disabled>-Kelas-</option>
                                                            @foreach ($data_kelas as $k)
                                                                <option value={{ $k->id }}>{{ $k->nama_kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kelas_doa_tambah')
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
                                                    <div id="form_tambah_doa_1">
                                                        <div class="form-group">
                                                            <label for="tambah_doa_guru_1">Pilih Guru</label>
                                                            <select class="custom-select" name="tambah_doa_guru_1"
                                                                id="tambah_doa_guru_1">
                                                                <option selected disabled>-Guru-</option>
                                                                @foreach ($data_guru as $g)
                                                                    <option value={{ $g->id }}>
                                                                        {{ $g->nama_guru }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('tambah_doa_guru_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tambah_doa_1">Tambah Doa</label>
                                                            <input type="text" class="form-control"
                                                                name="tambah_doa_1" id="tambah_doa_1"
                                                                placeholder="Masukkan Doa">
                                                            @error('tambah_doa_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div id="tambah_doa_tambah">
                                                        {{-- Akan ditambahkan melalui ajax --}}
                                                    </div>

                                                    <div id="tambah_doa_button">

                                                        <x-adminlte-button type="button" id="kurang_doa"
                                                        class="btn bg-red col-12 kurang_doa"
                                                        icon="fas fa fa-fw fa-minus" label="Hapus Doa"/>

                                                        <x-adminlte-button type="button" id="tambah_doa"
                                                            class="btn-outline-secondary col-12 tambah_doa"
                                                            icon="fas fa fa-fw fa-plus" label="Tambah Doa" />   
                                                        

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

<!-- Bootstrap 4 -->
<script type="text/javascript" src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
<script src={{ asset('public/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js') }}></script>
@stop
@section('js')

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    });
</script>

<script>
//tambah doa
    $(document).ready(function() {
        $('#kurang_doa').hide();
        var i = 1;
        $('#tambah_doa').click(function() {
            i++;
            $('#tambah_doa_tambah').append(
                '<hr id="garis' + i +
                '"> <div id="form_tambah_doa_' + i +
                '"><div class="form-group"><label for="tambah_doa_guru_' + i +
                '">Pilih Guru</label><select class="custom-select" name="tambah_doa_guru_' + i +
                '" id="tambah_doa_guru_' + i +
                '"><option selected disabled>-Guru-</option>@foreach ($data_guru as $g)<option value={{ $g->id }}>{{ $g->nama_guru }}</option>@endforeach</select>@error("tambah_doa_guru_' +
                i +
                '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="form-group"><label for="tambah_doa_' +
                i +
                '">Tambah Doa</label><input type="text" class="form-control" name="tambah_doa_' + i +
                '" id="tambah_doa_' + i +
                '" placeholder="Masukkan Doa">@error("tambah_doa_' + i +
                '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div>'
            );
            $('#kurang_doa').show();
        });

        $('#kurang_doa').click(function() {
            $('#garis' + i).remove();
            $('#form_tambah_doa_' + i).remove();
            i--;
            if (i == 1) {
                $('#kurang_doa').hide();
            }
        });
    });
</script>

<script>
    //aler on form_tambah_doa submit
    $(document).on('submit', '#form_tambah_doa', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data Akan Segera Disimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('data_doa.store') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_tambah_doa').serialize(),
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
                            $('#form_tambah_doa .invalid-feedback').remove();
                            $('#form_tambah_doa select').removeClass(
                                'is-invalid');
                            $('#form_tambah_doa input').removeClass(
                                'is-invalid');
                            
                            $.each(errors.responseJSON.errors, function(key, value) {
                                $('#form_tambah_doa #' + key).addClass(
                                    'is-invalid');
                                $('#form_tambah_doa #' + key).parent().find(
                                    '.invalid-feedback').remove();
                                $('#form_tambah_doa #' + key).parent().append(
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
                url: "{{ route('dataDoa.getTable') }}",
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
                    data: 'nama_nilai',
                    name: 'nama_nilai'
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
                    url: "{{ route('dataDoa.getTable') }}",
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
                    data: 'nama_nilai',
                    name: 'nama_nilai'
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

<script>
    //delete via ajax with sweet alert
    $(document).on('click', '.delete', function() {
        let doa_id = $(this).attr('data-id');
        let url = '{{ route('dataDoa.destroy', ':doa_id') }}';
        url = url.replace(':doa_id', doa_id);
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
