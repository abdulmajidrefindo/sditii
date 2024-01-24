@extends('adminlte::page')

{{-- @section('title', 'Rapor Siswa') --}}

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
        <h1 class="m-0">Rapor Siswa</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('raporSiswa') }}
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
                    {{-- tab control --}}
                    <ul class="nav nav-tabs" id="kategori-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="controller-tab-rapor-table" data-toggle="pill"
                            href="#content-tab-rapor-table" role="tab" aria-controls="content-tab-rapor-table"
                            aria-selected="true">
                            <i class="fas fa-xs fa-table fa-fw"></i>
                            Rapor Siswa @if (isset($kelas_aktif))
                            {{ $kelas_aktif->kelas->nama_kelas . ' ' . $kelas_aktif->nama_sub_kelas }}
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="controller-tab-print-per-kelas" data-toggle="pill"
                        href="#content-tab-print-per-kelas" role="tab"
                        aria-controls="content-tab-print-per-kelas" aria-selected="false"><i class="fas fa-book mr-1"></i>Print Per Kelas</a>
                    </li>
                    {{-- @if (Auth::user()->role->contains('role', 'Administrator')) --}}
                    <li class="nav-item">
                        <a class="nav-link" id="controller-tab-rapor-atur" data-toggle="pill"
                        href="#content-tab-rapor-atur" role="tab" aria-controls="content-tab-rapor-atur"
                        aria-selected="false">
                        <i class="fas fa-xs fa-plus fa-fw"></i>
                        Atur Raport</a>
                    </li>
                    {{-- @endif --}}
                </ul>
            </div>
            
            <div class="card-body">
                <div class="tab-content" id="raporTabContent">
                    <div class="tab-pane active show" id="content-tab-rapor-table" role="tabpanel" aria-labelledby="controller-tab-rapor-table">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th class="text-center" style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($data_siswa as $s)
                            <tr>
                                <td>{{ $s->nama_siswa }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>{{ $s->sub_kelas->kelas->nama_kelas . ' ' . $s->sub_kelas->nama_sub_kelas }}</td>
                                <td>{{ $s->sub_kelas->guru->nama_guru }}</td>
                                <td class="text-center">
                                    <a href="{{ url('/') }}/raporSiswa/{{ $s->id }}/detail" class="btn btn-sm btn-success mx-1 shadow">Detail</a>
                                    <a href="{{ url('/') }}/raporSiswa/{{ $s->id }}/{{ null }}/print" class="btn btn-sm btn-success mx-1 shadow">Print</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    {{-- Print Per Kelas --}}
                    <div class="tab-pane fade" id="content-tab-print-per-kelas" role="tabpanel" aria-labelledby="controller-tab-print-per-kelas">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bs-stepper-content">
                                    <form action="{{ url('/') }}/raporSiswa/{{ $s->id }}/{{ null }}/print"
                                        method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="kelas">Pilih Kelas</label>
                                            <div class="input-group">
                                                <select class="custom-select" name="sub_kelas_id"
                                                id="sub_kelas_id">
                                                <option selected disabled>-Kelas-</option>
                                                <option>Kelas</option>
                                                {{-- @foreach ($kelas as $k)
                                                    <option value={{ $k->id }}>
                                                        {{ $k->nama_kelas }}
                                                    </option>
                                                    @endforeach --}}
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
                    </div>
                    {{-- Print Per Kelas --}}
                    <div class="tab-pane fade" id="content-tab-rapor-atur" role="tabpanel" aria-labelledby="controller-tab-rapor-atur">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bs-stepper-content">
                                    <form id="form_tambah_periode" method="POST" action="{{ url('/') }}/raporSiswa/{{ $rapor_siswa->id }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="tempat">Tempat</label>
                                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" placeholder="Tempat" value="{{ $rapor_siswa->tempat }}">
                                            @error('tempat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="Tanggal" value="{{ date('Y-m-d', strtotime($rapor_siswa->tanggal)) }}">
                                            @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        {{-- Simpan --}}
                                        <x-adminlte-button type="submit"
                                        class="btn bg-gradient-green col-12 simpan" icon="fas fa fa-fw fa-save"
                                        label="Simpan Data" />
                                    </form>
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
        <script type="text/javascript">
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>
        
        <script>
            //if theres simpan_gagal, show sweet alert
            $(document).ready(function() {
                var simpan_gagal = {!! json_encode(session('rapor_gagal')) !!};
                if (simpan_gagal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: simpan_gagal,
                    });
                }
                
                var simpan_sukses = {!! json_encode(session('rapor_berhasil')) !!};
                if (simpan_sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: simpan_sukses,
                    });
                }
            });
        </script>
        
        @stop
        