@extends('adminlte::page')

@section('title', 'Rapor Siswa')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Rapor Siswa</h1>
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
    @foreach ($data_siswa as $i)   
        <h1>{{ $i->id }}. {{ $i->nama_siswa }}</h1>
        <h3>Data Siswa</h3>
            <p>Orangtua/Wali: {{ $i->orangtua_wali }}</p>
            <p>NISN: {{ $i->nisn }}</p>
            <p>Kelas: {{ $i->kelas->nama_kelas }}</p>
            <p>Wali Kelas: {{ $i->kelas->guru->nama_guru }}</p>
    @endforeach
    <h3>Hasil</h3>
    <h5>Ilman Waa Ruuhan</h5>
    @foreach ($data_iwr as $i)
        <p>Pencapaian:</p>
        <p>{{ $i->ilman_waa_ruuhan->Pencapaian }}</p>
        <p>Jilid/Surah:</p>
        <p>{{ $i->ilman_waa_ruuhan->jilid }}</p>
        <p>Halaman/Ayat:</p>
        <p>{{ $i->ilman_waa_ruuhan->halaman }}</p>
        <p>Nilai:</p>
        <p>{{ $i->penilaian_deskripsi->deskripsi }} ({{ $i->penilaian_deskripsi->keterangan }})</p>
    @endforeach
    <h5>Bidang Studi</h5>
    @foreach ($data_mapel as $i)
        <p>Mata Pelajaran:</p>
        <p>{{ $i->tugas_mapel->bidang_studi->nama_mapel }}</p>
        <p>Nilai:</p>
        <p>{{ $i->penilaian_huruf_angka->nilai_angka }} ({{ $i->penilaian_huruf_angka->nilai_huruf }})</p>
    @endforeach
    <h5>Ibadah Harian</h5>
    @foreach ($data_ih as $i)
        <p>Kriteria:</p>
        <p>{{ $i->ibadah_harian->nama_kriteria }}</p>
        <p>Nilai:</p>
        <p>{{ $i->penilaian_deskripsi->deskripsi }} ({{ $i->penilaian_deskripsi->keterangan }})</p>
    @endforeach
    <h5>Tahfidz</h5>
    <h5>Hadist</h5>
    <h5>Doa</h5>
</body>
@stop