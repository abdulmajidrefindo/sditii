@extends('adminlte::page')

{{-- @section('title', 'Siswa Tahfidz') --}}

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
                    <div class="card-header p-0 pt-0 bg-gradient-green">
                        <ul class="nav nav-tabs" id="tahfidzTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-tahfidz-table" data-toggle="tab"
                                    href="#content-tab-tahfidz-table" role="tab" aria-controls="content-tab-tahfidz-table"
                                    aria-selected="true">Tabel Tahfidz</a>
                            </li>
                            @if (Auth::user()->role->contains('role', 'Administrator'))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tab-tahfidz-add" data-toggle="tab"
                                        href="#content-tab-tahfidz-add" role="tab" aria-controls="content-tab-tahfidz-add"
                                        aria-selected="false">Atur Penilaian Tahfidz</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tambah-tahfidz-add" data-toggle="tab"
                                        href="#content-tambah-tahfidz-add" role="tab"
                                        aria-controls="content-tambah-tahfidz-add" aria-selected="false">Tambah Tahfidz</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="tahfidzTabContent">
                            <div class="tab-pane active show" id="content-tab-tahfidz-table" role="tabpanel"
                                aria-labelledby="controller-tab-tahfidz-table">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <form action="{{ url('/') }}/tahfidz" method="post">
                                                @csrf
                                                <label for="kelas">Pilih Kelas</label>
                                                <div class="input-group">
                                                    <select class="custom-select" name="kelas_id" id="kelas_id">
                                                        <option selected disabled>-Kelas-</option>
                                                        @foreach ($data_sub_kelas as $k)
                                                            <option value={{ $k->id }} @if($kelas_aktif !== null && $k->id == $kelas_aktif->id) selected @endif>
                                                                {{ $k->nama_kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <x-adminlte-button type="submit" class="btn bg-gradient-green d-inline"
                                                            icon="fas fa fa-fw fa-save" label="Pilih" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>NISN</th>
                                            @foreach ($siswa_t as $siswa)
                                                @foreach ($siswa as $key => $value)
                                                    @if ($key !== 'siswa_id' && $key !== 'nama_siswa' && $key !== 'kelas' && $key !== 'nisn')
                                                        <th>{{ $key }}</th>
                                                    @endif
                                                @endforeach
                                            @break
                                        @endforeach
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa_t as $siswa)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $siswa['nama_siswa'] }}</td>
                                            <td>{{ $siswa['nisn'] }}</td>
                                            @foreach ($siswa as $key => $value)
                                                @if ($key !== 'siswa_id' && $key !== 'nama_siswa' && $key !== 'kelas' && $key !== 'nisn')
                                                    <td>
                                                        @if ($value == null)
                                                            <span class="badge badge-danger">Kosong</span>
                                                        @else
                                                            {{ $value }}
                                                        @endif
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td>
                                                <a href="{{ route('siswaTahfidz.show', $siswa['siswa_id']) }}"
                                                    class="btn btn-sm btn-success mx-1 shadow detail"><i
                                                        class="fas fa-sm fa-fw fa-eye"></i> Detail</a>
                                                <a href="javascript:void(0)" data-toggle="tooltip"
                                                    data-id="{{ $siswa['siswa_id'] }}" data-original-title="Delete"
                                                    class="btn btn-sm btn-danger mx-1 shadow delete"><i
                                                        class="fas fa-sm fa-fw fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (Auth::user()->role->contains('role', 'Administrator'))
                            {{-- Tab add content --}}
                            <div class="tab-pane fade" id="content-tab-tahfidz-add" role="tabpanel"
                                aria-labelledby="controller-tab-tahfidz-add">
                                <div class="card-body">
                                    <form id="form_daftar_tahfidz">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="bs-stepper-content">
                                                    {{-- Input Kelas --}}
                                                    <div class="form-group">
                                                        <label for="kelas">Pilih Kelas</label>
                                                        <select class="custom-select" name="kelas_tahfidz"
                                                            id="kelas_tahfidz">
                                                            <option selected>-Kelas-</option>
                                                            @foreach ($data_kelas as $k)
                                                                <option value={{ $k->id }}>{{ $k->nama_kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kelas_tahfidz')
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
                                                    <label for="kelas">Daftar Tahfidz</label>
                                                    <div id="daftar_tahfidz">
                                                        {{-- Akan ditambahkan melalui ajax --}}
                                                    </div>

                                                    <div id="tambah_tahfidz_button">
                                                        {{-- <x-adminlte-button type="button" id="tambah_tahfidz" class="btn-outline-secondary col-12 tambah_tahfidz" icon="fas fa fa-fw fa-plus" label="Tambah Tahfidz"/> --}}
                                                        <x-adminlte-button type="submit"
                                                            class="btn bg-gradient-green col-12 simpan"
                                                            icon="fas fa fa-fw fa-save" label="Simpan Data" />
                                                        <br>
                                                    </div>
                                                    {{-- Simpan --}}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            {{-- Tab add content end --}}
                        @endif

                        @if (Auth::user()->role->contains('role', 'Administrator'))
                            {{-- Tab add content --}}
                            <div class="tab-pane fade" id="content-tambah-tahfidz-add" role="tabpanel"
                                aria-labelledby="controller-tambah-tahfidz-add">
                                <div class="card-body">
                                    <form id="form_tambah_tahfidz">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="bs-stepper-content">
                                                    {{-- Input Kelas --}}
                                                    <div class="form-group">
                                                        <label for="kelas">Pilih Kelas</label>
                                                        <select class="custom-select" name="kelas_tahfidz_tambah"
                                                            id="kelas_tahfidz_tambah">
                                                            <option selected disabled>-Kelas-</option>
                                                            @foreach ($data_kelas as $k)
                                                                <option value={{ $k->id }}>{{ $k->nama_kelas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kelas_tahfidz_tambah')
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
                                                    <div id="form_tambah_tahfidz_1">
                                                        <div class="form-group">
                                                            <label for="tambah_tahfidz_guru_1">Pilih Guru</label>
                                                            <select class="custom-select" name="tambah_tahfidz_guru_1"
                                                                id="tambah_tahfidz_guru_1">
                                                                <option selected disabled>-Guru-</option>
                                                                @foreach ($data_guru as $g)
                                                                    <option value={{ $g->id }}>
                                                                        {{ $g->nama_guru }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('tambah_tahfidz_guru_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tambah_tahfidz_1">Tambah Tahfidz</label>
                                                            <input type="text" class="form-control"
                                                                name="tambah_tahfidz_1" id="tambah_tahfidz_1"
                                                                placeholder="Masukkan Tahfidz">
                                                            @error('tambah_tahfidz_1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div id="tambah_tahfidz_tambah">
                                                        {{-- Akan ditambahkan melalui ajax --}}
                                                    </div>

                                                    <div id="tambah_tahfidz_button">

                                                        <x-adminlte-button type="button" id="kurang_tahfidz"
                                                            class="btn bg-red col-12 kurang_tahfidz"
                                                            icon="fas fa fa-fw fa-minus" label="Hapus Tahfidz" />

                                                        <x-adminlte-button type="button" id="tambah_tahfidz"
                                                            class="btn-outline-secondary col-12 tambah_tahfidz"
                                                            icon="fas fa fa-fw fa-plus" label="Tambah Tahfidz" />



                                                    </div>
                                                    {{-- Simpan --}}
                                                </div>

                                                <hr>
                                                <x-adminlte-button type="submit" class="btn bg-gradient-green col-12 simpan"
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
        $('#tambah_tahfidz_button').hide();
    });
</script>

<script>
    //tambah tahfidz
        $(document).ready(function() {
            $('#kurang_tahfidz').hide();
            var i = 1;
            $('#tambah_tahfidz').click(function() {
                i++;
                $('#tambah_tahfidz_tambah').append(
                    '<hr id="garis' + i +
                    '"> <div id="form_tambah_tahfidz_' + i +
                    '"><div class="form-group"><label for="tambah_tahfidz_guru_' + i +
                    '">Pilih Guru</label><select class="custom-select" name="tambah_tahfidz_guru_' + i +
                    '" id="tambah_tahfidz_guru_' + i +
                    '"><option selected disabled>-Guru-</option>@foreach ($data_guru as $g)<option value={{ $g->id }}>{{ $g->nama_guru }}</option>@endforeach</select>@error("tambah_tahfidz_guru_' +
                    i +
                    '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="form-group"><label for="tambah_tahfidz_' +
                    i +
                    '">Tambah Tahfidz</label><input type="text" class="form-control" name="tambah_tahfidz_' + i +
                    '" id="tambah_tahfidz_' + i +
                    '" placeholder="Masukkan Tahfidz">@error("tambah_tahfidz_' + i +
                    '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div></div>'
                );
                $('#kurang_tahfidz').show();
            });
    
            $('#kurang_tahfidz').click(function() {
                $('#garis' + i).remove();
                $('#form_tambah_tahfidz_' + i).remove();
                i--;
                if (i == 1) {
                    $('#kurang_tahfidz').hide();
                }
            });
        });
    </script>

<script>
    //aler on form_tambah_tahfidz submit
    $(document).on('submit', '#form_tambah_tahfidz', function(e) {
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
                    url: '{{ route('data_tahfidz.store') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_tambah_tahfidz').serialize(),
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
                            $('#form_tambah_tahfidz .invalid-feedback').remove();
                            $('#form_tambah_tahfidz select').removeClass(
                                'is-invalid');
                            $('#form_tambah_tahfidz input').removeClass(
                                'is-invalid');

                            $.each(errors.responseJSON.errors, function(key, value) {
                                $('#form_tambah_tahfidz #' + key).addClass(
                                    'is-invalid');
                                $('#form_tambah_tahfidz #' + key).parent().find(
                                    '.invalid-feedback').remove();
                                $('#form_tambah_tahfidz #' + key).parent().append(
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

        //On kelas_tahfidz change, loop through all kelas_tahfidz from ajax and append to #daftar_tahfidz
        $('select[name="kelas_tahfidz"]').on('change', function() {
            var kelas_tahfidz = $(this).val();

            $.ajax({
                url: '/tahfidz/getKelasTahfidz/' + kelas_tahfidz,
                type: "GET",
                data: {
                    kelas_tahfidz: kelas_tahfidz
                },
                dataType: "json",
                success: function(data) {
                    $('#daftar_tahfidz').empty();
                    $.each(data, function(index, value) {
                        $('#daftar_tahfidz').append(
                            '<div class="form-group input-group"><input type="text" class="form-control" name="tahfidz_' +
                            value.id + '" id="tahfidz_' + value.id +
                            '" placeholder="Masukkan Tahfidz" value="' + value
                            .nama_nilai +
                            '" ><div class="input-group-append"><button data-id="' +
                            value.id +
                            '" class="btn btn-outline bg-red delete-tahfidz" type="button">Hapus</button></div><div class="invalid-feedback"></div></div>'
                        );
                    });
                }
            });

            $('#tambah_tahfidz_button').show();
        });
    });
</script>

<script>
    //aler on form_daftar_tahfidz submit
    $(document).on('submit', '#form_daftar_tahfidz', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!'
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('data_tahfidz.update') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_daftar_tahfidz').serialize(),
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

<script>
    $(document).on('click', '.delete-tahfidz', function() {
        //get the parent div
        var parent = $(this).parent().parent();
        //get the parent name
        var parent_input = parent.find('input');
        let tahfidz_id = $(this).attr('data-id');
        //disable the input by add disabled-form class
        parent_input.addClass('disabled-form');
        //change the input name
        parent_input.attr('name', 'delete_' + tahfidz_id);
        // change the button to cancel
        $(this).html('Batal');
        $(this).removeClass('delete-tahfidz');
        $(this).addClass('cancel-delete-tahfidz');
        $(this).removeClass('bg-red');
        $(this).addClass('bg-secondary');
    });

    $(document).on('click', '.cancel-delete-tahfidz', function() {
        //get the parent div
        var parent = $(this).parent().parent();
        //get the parent name
        var parent_input = parent.find('input');
        let tahfidz_id = $(this).attr('data-id');
        //enable the input
        parent_input.removeClass('disabled-form');
        //change the input name
        parent_input.attr('name', 'tahfidz_' + tahfidz_id);
        // change the button to cancel
        $(this).html('Hapus');
        $(this).removeClass('cancel-delete-tahfidz');
        $(this).addClass('delete-tahfidz');
        $(this).addClass('bg-red');
    });
</script>

<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    // $(function () {
    //   $("#example1").DataTable({
    //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //   }).buttons().container().appendTo('example1_wrapper .col-md-6:eq(0)');
    //   $("#example1").DataTable({
    //     "paging": false,
    //     "lengthChange": true,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": true,
    //     "responsive": true,
    //   });
    // });
</script>

<script>
    //delete via ajax with sweet alert
    $(document).on('click', '.delete', function() {
        let id = $(this).attr('data-id');
        let url = '{{ route('siswaTahfidz.destroy', ':id') }}';
        url = url.replace(':id', id);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
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
