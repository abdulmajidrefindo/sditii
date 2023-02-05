@extends('adminlte::page')

@section('title', 'Ibadah Harian')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Ibadah Harian</h1>
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
    @foreach ($siswa_ih as $s)
        <h3>{{ $s->siswa->id }}. {{ $s->siswa->nama_siswa }} (Kelas: {{ $s->siswa->nisn }}) (NISN: {{ $s->siswa->kelas->nama_kelas }})</h3>
        <p>Nilai {{ $s->ibadah_harian->id }}: {{ $s->ibadah_harian->nama_kriteria }} = {{ $s->penilaian_deskripsi->deskripsi }} / {{ $s->penilaian_deskripsi->keterangan }}</p>
        <p>Pengajar: {{ $s->ibadah_harian->guru->nama_guru }}</p>
    @endforeach
</body>
@stop