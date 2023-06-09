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
    <h1>Data Siswa</h1>
    @foreach ($data_siswa as $i)   
        <h3>{{ $i->id }}. {{ $i->nama_siswa }}</h3>
            <p>Orangtua/Wali: {{ $i->orangtua_wali }}</p>
            <p>NISN: {{ $i->nisn }}</p>
            <p>Kelas: {{ $i->kelas->nama_kelas }}</p>
            <p>Wali Kelas: {{ $i->kelas->guru->nama_guru }}</p>
    @endforeach
    <h1>Hasil</h3>
    <h3>Ilman Waa Ruuhan</h3>
    @foreach ($data_iwr as $j)
        <p>Pencapaian:</p>
        <p>{{ $j->ilman_waa_ruuhan->Pencapaian }}</p>
        <p>Jilid/Surah:</p>
        <p>{{ $j->ilman_waa_ruuhan->jilid }}</p>
        <p>Halaman/Ayat:</p>
        <p>{{ $j->ilman_waa_ruuhan->halaman }}</p>
        <p>Nilai:</p>
        <p>{{ $j->penilaian_deskripsi->deskripsi }} ({{ $j->penilaian_deskripsi->keterangan }})</p>
    @endforeach
    <h5>Bidang Studi</h5>
    @foreach ($data_mapel as $k)
        <p>Mata Pelajaran:</p>
        <p>{{ $k->tugas_mapel->bidang_studi->nama_mapel }}</p>
        <p>Nilai:</p>
        <p>{{ $k->penilaian_huruf_angka->nilai_angka }} ({{ $k->penilaian_huruf_angka->nilai_huruf }})</p>
    @endforeach
    <h5>Ibadah Harian</h5>
    @foreach ($data_ih as $l)
        <p>Kriteria:</p>
        <p>{{ $l->ibadah_harian->nama_kriteria }}</p>
        <p>Nilai:</p>
        <p>{{ $l->penilaian_deskripsi->deskripsi }} ({{ $l->penilaian_deskripsi->keterangan }})</p>
    @endforeach
    <h5>Tahfidz</h5>
    @foreach ($data_t as $m)
        <p>Kriteria:</p>
        <p>{{ $m->Tahfidz->nama_surat }}</p>
        <p>Nilai:</p>
        <p>{{ $m->penilaian_huruf_angka->nilai_angka }} ({{ $m->penilaian_huruf_angka->nilai_huruf }})</p>
    @endforeach
    <h5>Hadist</h5>
    @foreach ($data_h as $n)
        <p>Kriteria:</p>
        <p>{{ $n->Hadist->nama_hadist }}</p>
        <p>Nilai:</p>
        <p>{{ $n->penilaian_huruf_angka->nilai_angka }} ({{ $n->penilaian_huruf_angka->nilai_huruf }})</p>
    @endforeach
    <h5>Doa</h5>
    @foreach ($data_d as $o)
        <p>Kriteria:</p>
        <p>{{ $o->Doa->nama_doa }}</p>
        <p>Nilai:</p>
        <p>{{ $o->penilaian_huruf_angka->nilai_angka }} ({{ $o->penilaian_huruf_angka->nilai_huruf }})</p>
    @endforeach
</body>
@stop