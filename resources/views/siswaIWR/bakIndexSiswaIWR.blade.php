@extends('adminlte::page')

@section('title', 'Ilman Waa Ruuhan')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Ilman Waa Ruuhan</h1>
    </div>
    <div class="col-sm-6">
        {{-- <ol class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('merek') }}
        </ol> --}}
    </div>
</div>
@stop

@section('content')
<!-- /.card -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>
  
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Nilai</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Pencapaian</th>
                        <th>Jilid</th>
                        <th>Halaman</th>
                        <th>Nilai</th>
                        <th>Pengajar</th>
                    </tr>
                </thead>
    @foreach ($siswa_i as $s)
    <tr>
        <td>{{ $s->siswa->nama_siswa }}</td>
        <td>{{ $s->siswa->nisn }}</td>
        <td>{{ $s->siswa->kelas->nama_kelas }}</td>
        <td>{{ $s->ilman_waa_ruuhan->pencapaian }}</td>
        <td>{{ $s->ilman_waa_ruuhan->jilid }}</td>
        <td>{{ $s->ilman_waa_ruuhan->halaman }}</td>
        <td>{{ $s->penilaian_deskripsi->deskripsi }} / {{ $s->penilaian_deskripsi->keterangan }}</td>
        <td>{{ $s->ilman_waa_ruuhan->guru->nama_guru }}</td>
</tr>
@endforeach
<tbody>
</tfoot>
</table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</body>
@stop