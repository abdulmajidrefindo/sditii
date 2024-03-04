@extends('adminlte::page')

@section('title', 'Dashboard')

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
@stop

@section('content')
<div class="container-fluid">
    
    <div class="row">
        <div class="callout callout-success col-12">
            <h5><b>E-Rapor MDTA SDIT Irsyadul 'Ibad 2 Pandeglang</b></h5>
            <p> Tahun Pelajaran {{ $periode->tahun_ajaran }} Semester @if ($periode->semester == 1)
                Ganjil @else Genap @endif</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah User</span>
                        <span class="info-box-number">{{ $user }}</span>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Guru</span>
                        <span class="info-box-number">{{ $guru }}</span>
                    </div>
                    
                </div>
                
            </div>
            
            
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Kelas</span>
                        <span class="info-box-number">{{ $kelas }}</span>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Siswa</span>
                        <span class="info-box-number">{{ $siswa }}</span>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
        <div class="row">
            {{--             
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header bg-gradient-green">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i>
                                Pengumuman
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="timeline">
                                        
                                        @foreach ($pengumuman as $tanggal => $items)
                                        <div class="time-label">
                                            <span class="bg-success">{{ $tanggal }}</span>
                                        </div>
                                        @foreach ($items as $item)
                                        <div>
                                            <i class="fas fa-envelope bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ $item['time'] }}</span>
                                                <h3 class="timeline-header"><a href="#">{{ $item['judul'] }}</a></h3>
                                                <div class="timeline-body">
                                                    {{ $item['isi'] }}
                                                </div>
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                        @endforeach
                                        
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> --}}
                
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header bg-gradient-green">
                            <h3 class="card-title">
                                <i class="fas fa-building"></i>
                                Profil Sekolah
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4">Nama Sekolah :</label>
                                        <div class="col-sm-8">
                                            {{ $profil->nama_sekolah }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4">Alamat Sekolah :</label>
                                        <div class="col-sm-8">
                                            {{ $profil->alamat_sekolah }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4">Email Sekolah :</label>
                                        <div class="col-sm-8">
                                            {{ $profil->email_sekolah }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4">Kontak Sekolah :</label>
                                        <div class="col-sm-8">
                                            {{ $profil->kontak_sekolah }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4">Website Sekolah :</label>
                                        <div class="col-sm-8">
                                            {{ $profil->website_sekolah }}
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @stop
            