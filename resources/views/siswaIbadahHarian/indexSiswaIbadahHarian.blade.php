@extends('adminlte::page')

{{-- @section('title', 'Siswa IbadahHarian') --}}

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
            <h1 class="m-0">Nilai Ibadah Harian Siswa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('siswaIbadahHarian') }}
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-0 bg-gradient-green">
                        <ul class="nav nav-tabs" id="ibadahHarianTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-ibadah-harian-table" data-toggle="tab"
                                    href="#content-tab-ibadah-harian-table" role="tab"
                                    aria-controls="content-tab-ibadah-harian-table" aria-selected="true">Nilai Siswa</a>
                                </li>
                                @if (Auth::user()->role->contains('role', 'Administrator'))
                                
                                <li class="nav-item" role="presentation" hidden>
                                    <a class="nav-link" id="controller-tambah-ibadah-harian-add" data-toggle="tab"
                                    href="#content-tambah-ibadah-harian-add" role="tab"
                                    aria-controls="content-tambah-ibadah-harian-add" aria-selected="false">Tambah Penilaian</a>
                                </li>
                                <li class="nav-item" role="presentation" hidden>
                                    <a class="nav-link" id="controller-tab-ibadah-harian-add" data-toggle="tab"
                                    href="#content-tab-ibadah-harian-add" role="tab"
                                    aria-controls="content-tab-ibadah-harian-add" aria-selected="false">Ubah Penilaian</a>
                                </li>
                                
                                @endif
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="controller-tab-ibadah-harian-export-import" data-toggle="tab"
                                    href="#content-tab-ibadah-harian-export-import" role="tab"
                                    aria-controls="content-tab-ibadah-harian-export-import"
                                    aria-selected="false">Ekspor/Impor Nilai</a>
                                </li>
                                
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
                                                        @foreach ($data_sub_kelas as $k)
                                                        <option value={{ $k->id }}
                                                            @if ($kelas_aktif !== null && $k->id == $kelas_aktif->id) selected @endif>
                                                            {{ $k->nama_kelas }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <x-adminlte-button type="submit"
                                                            class="btn bg-gradient-green d-inline"
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
                                                @foreach ($siswa_ib as $siswa)
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
                                            @foreach ($siswa_ib as $siswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $siswa['nama_siswa'] }}</td>
                                                <td>{{ $siswa['nisn'] }}</td>
                                                @foreach ($siswa as $key => $value)
                                                @if ($key !== 'siswa_id' && $key !== 'nama_siswa' && $key !== 'kelas' && $key !== 'nisn')
                                                <td>
                                                    @if ($value == 'Kosong')
                                                    <span class="badge badge-danger">Kosong</span>
                                                    @else
                                                    {{ $value }}
                                                    @endif
                                                </td>
                                                @endif
                                                @endforeach
                                                <td>
                                                    <a href="{{ route('siswaIbadahHarian.show', $siswa['siswa_id']) }}"
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
                                <div class="tab-pane fade" id="content-tab-ibadah-harian-add" role="tabpanel"
                                aria-labelledby="controller-tab-ibadah-harian-add">
                                <div class="card-body">
                                    <form id="form_daftar_ibadah_harian">
                                        @csrf
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                
                                                <div class="bs-stepper-content">
                                                    {{-- Input Kelas --}}
                                                    <div class="form-group">
                                                        <label for="kelas">Pilih Kelas</label>
                                                        <select class="custom-select" name="kelas_ibadah_harian"
                                                        id="kelas_ibadah_harian">
                                                        <option selected>-Kelas-</option>
                                                        @foreach ($data_kelas as $k)
                                                        <option value={{ $k->id }}>{{ $k->nama_kelas }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kelas_ibadah_harian')
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
                                                <label for="kelas">Daftar IbadahHarian</label>
                                                <div id="daftar_ibadah_harian">
                                                    {{-- Akan ditambahkan melalui ajax --}}
                                                </div>
                                                
                                                <div id="tambah_ibadah_harian_button">
                                                    {{-- <x-adminlte-button type="button" id="tambah_ibadah_harian" class="btn-outline-secondary col-12 tambah_ibadah_harian" icon="fas fa fa-fw fa-plus" label="Tambah IbadahHarian"/> --}}
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
                                                <select class="custom-select"
                                                name="kelas_ibadah_harian_tambah"
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
                                                <select class="custom-select"
                                                name="tambah_ibadah_harian_guru_1"
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
                                            <label for="tambah_ibadah_harian_1">Tambah
                                                IbadahHarian</label>
                                                <input type="text" class="form-control"
                                                name="tambah_ibadah_harian_1"
                                                id="tambah_ibadah_harian_1"
                                                placeholder="Masukkan IbadahHarian">
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
                                            icon="fas fa fa-fw fa-minus" label="Hapus IbadahHarian" />
                                            
                                            <x-adminlte-button type="button" id="tambah_ibadah_harian"
                                            class="btn-outline-secondary col-12 tambah_ibadah_harian"
                                            icon="fas fa fa-fw fa-plus" label="Tambah IbadahHarian" />
                                            
                                            
                                            
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
                
                {{-- Tab export-import content --}}
                <div class="tab-pane fade" id="content-tab-ibadah-harian-export-import" role="tabpanel"
                aria-labelledby="controller-tab-ibadah-harian-export-import">
                <div class="card-body">
                    <div class="row">
                        {{-- Export Data Ibadah Harian --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-gradient-green">
                                    <h3 class="card-title">Ekspor Data Ibadah Harian</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/') }}/ibadahHarian/export_excel"
                                    method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kelas">Pilih Kelas</label>
                                        <div class="input-group">
                                            <select class="custom-select" name="sub_kelas_id"
                                            id="sub_kelas_id">
                                            <option selected disabled>-Kelas-</option>
                                            @foreach ($data_sub_kelas as $k)
                                            <option value={{ $k->id }}>
                                                {{ $k->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <x-adminlte-button type="submit"
                                                class="btn bg-gradient-green d-inline"
                                                icon="fas fa fa-fw fa-save" label="Ekspor" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Export Data Ibadah Harian --}}
                    {{-- Import Data Ibadah Harian --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-gradient-green">
                                <h3 class="card-title">Impor Data Ibadah Harian</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('/') }}/ibadahHarian/import_excel" method="post"
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
            </div>
            {{-- End Import Data Ibadah Harian --}}
        </div>
    </div>
    <div class=" d-flex justify-content-center">
        <div class="alert alert-info alert-dismissible">
            <div>
                <h5><i class="icon fas fa-info"></i>
                    Cara impor data nilai dari file excel:
                </h5>
                1. Ekspor data nilai terlebih dahulu<br>2. Modifikasi file excel yang diekspor tersebut<br>3. Pilih dan impor file excel yang sudah dimodifikasi</div>
            </div>
        </div>
    </div>
</div>
{{-- Tab export-import content end --}}

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
        $('#tambah_ibadah_harian_button').hide();
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
                '">Pilih Guru</label><select class="custom-select" name="tambah_ibadah_harian_guru_' +
                i +
                '" id="tambah_ibadah_harian_guru_' + i +
                '"><option selected disabled>-Guru-</option>@foreach ($data_guru as $g)<option value={{ $g->id }}>{{ $g->nama_guru }}</option>@endforeach</select>@error("tambah_ibadah_harian_guru_' +
                i +
                '")<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="form-group"><label for="tambah_ibadah_harian_' +
                    i +
                    '">Tambah IbadahHarian</label><input type="text" class="form-control" name="tambah_ibadah_harian_' +
                    i +
                    '" id="tambah_ibadah_harian_' + i +
                    '" placeholder="Masukkan IbadahHarian">@error("tambah_ibadah_harian_' + i +
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
                                        $('#form_tambah_ibadah_harian #' + key).parent()
                                        .find(
                                        '.invalid-feedback').remove();
                                        $('#form_tambah_ibadah_harian #' + key).parent()
                                        .append(
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
                    
                    //On kelas_ibadah_harian change, loop through all kelas_ibadah_harian from ajax and append to #daftar_ibadah_harian
                    $('select[name="kelas_ibadah_harian"]').on('change', function() {
                        var kelas_ibadah_harian = $(this).val();
                        
                        $.ajax({
                            url: '/ibadahHarian/getKelasIbadahHarian/' + kelas_ibadah_harian,
                            type: "GET",
                            data: {
                                kelas_ibadah_harian: kelas_ibadah_harian
                            },
                            dataType: "json",
                            success: function(data) {
                                $('#daftar_ibadah_harian').empty();
                                $.each(data, function(index, value) {
                                    $('#daftar_ibadah_harian').append(
                                    '<div class="form-group input-group"><input type="text" class="form-control" name="ibadah_harian_' +
                                        value.id + '" id="ibadah_harian_' + value.id +
                                        '" placeholder="Masukkan IbadahHarian" value="' +
                                        value
                                        .nama_kriteria +
                                        '" ><div class="input-group-append"><button data-id="' +
                                            value.id +
                                            '" class="btn btn-outline bg-red delete-ibadah-harian" type="button">Hapus</button></div><div class="invalid-feedback"></div></div>'
                                            );
                                        });
                                    }
                                });
                                
                                $('#tambah_ibadah_harian_button').show();
                            });
                        });
                    </script>
                    
                    <script>
                        //aler on form_daftar_ibadah_harian submit
                        $(document).on('submit', '#form_daftar_ibadah_harian', function(e) {
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
                                        url: '{{ route('data_ibadah_harian.update') }}',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: $('#form_daftar_ibadah_harian').serialize(),
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
                    
                    <script type="text/javascript">
                        $(function() {
                            $("#example1").DataTable({
                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                //"buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
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
                                        let url = '{{ route('siswaIbadahHarian.destroy', ':id') }}';
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
                                
                                {{-- Logika Berkaitan Dengan Import --}}
                                
                                <script>
                                    $(document).ready(function() {
                                        // Listen for changes in the file input, and update the text
                                        // inside the span next to it accordingly
                                        $('#file_nilai_excel').on('change', function() {
                                            // Get the name of the file
                                            var fileName = $(this).val().split('\\').pop();
                                            
                                            //get the file extension
                                            var fileExtension = ['xls', 'xlsx'];
                                            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) ==
                                            -1) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagal',
                                                    text: 'File harus berupa excel!',
                                                });
                                                $('#file_nilai_excel').val('');
                                                $('#file_nilai_excel').next().text('Pilih File');
                                            } else {
                                                //replace the "Choose a file" label
                                                $(this).next().text(fileName);
                                            }
                                        });
                                        
                                    });
                                </script>
                                
                                <script>
                                    //if theres upload_error, show sweet alert
                                    $(document).ready(function() {
                                        var upload_error = {!! json_encode(session('upload_error')) !!};
                                        if (upload_error) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                text: upload_error,
                                            });
                                        }
                                        
                                        var upload_success = {!! json_encode(session('upload_success')) !!};
                                        if (upload_success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: upload_success,
                                            });
                                        }
                                    });
                                </script>
                                
                                @stop
                                