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
    @foreach ($rapor as $r)
        <h3>Data Siswa</h3>
            <p>{{ $r->siswa->id }}. {{ $r->siswa->nama_siswa }}</p>
            <p>Orangtua/Wali: {{ $r->siswa->orangtua_wali }}</p>
            <p>NISN: {{ $r->siswa->nisn }}</p>
            <p>Kelas: {{ $r->siswa->kelas->nama_kelas }}</p>
            <p>Wali Kelas: {{ $r->siswa->kelas->guru->nama_guru }}</p>
        <h3>Hasil</h3>
        <h5>Ilman Waa Ruuhan</h5>
            <p>Pencapaian:</p>
            <p>{{ $r->siswa->siswa_iwr->ilman_waa_ruuhan->pencapaian }}</p>
            <p>Jilid/Surah:</p>
            <p>{{ $r->siswa->siswa_iwr->ilman_waa_ruuhan->jilid }}</p>
            <p>Halaman/Ayat:</p>
            <p>{{ $r->siswa->siswa_iwr->ilman_waa_ruuhan->halaman }}</p>
            <p>Nilai:</p>
            <p>{{ $r->siswa->siswa_iwr->penilaian_deskripsi->deskripsi }} ({{ $r->siswa->siswa_iwr->penilaian_deskripsi->keterangan }})</p>
        <h5>Bidang Studi</h5>
            <p>Mata Pelajaran:</p>
            <p>{{ $r->siswa->siswa_mapel->bidang_studi->nama_mapel }}</p>
            <p>Nilai:</p>
            <p>{{ $r->siswa->siswa_mapel->penilaian_huruf_angka->nilai_angka }} ({{ $r->siswa->siswa_mapel->penilaian_huruf_angka->nilai_huruf }})</p>
        <h5>Ibadah Harian</h5>
            <p>Kriteria:</p>
            <p>{{ $r->siswa->siswa_ibadah_harian->ibadah_harian->nama_kriteria }}</p>
            <p>Nilai:</p>
            <p>{{ $r->siswa->siswa_ibadah_harian->penilaian_huruf_angka->nilai_angka }} ({{ $r->siswa->siswa_ibadah_harian->penilaian_huruf_angka->nilai_huruf }})</p>
        <h5>Tahfidz</h5>
        <h5>Hadist</h5>
        <h5>Doa</h5>
    @endforeach
</body>
@stop