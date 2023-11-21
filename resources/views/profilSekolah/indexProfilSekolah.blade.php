@extends('adminlte::page')

{{-- @section('title', 'Profil Sekolah') --}}

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
            <h1 class="m-0">Profil Sekolah</h1>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title"><b>Profil Sekolah</b></h3>
                    </div>
                    <form action="{{ route('profilSekolah.update', $profil->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="form-group row">
                                        <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('nama_sekolah') is-invalid @enderror"
                                                id="nama_sekolah" placeholder="Nama Sekolah" name="nama_sekolah"
                                                value="{{ $profil->nama_sekolah }}" readonly>
                                            @error('nama_sekolah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="alamat_sekolah" class="col-sm-2 col-form-label">Alamat Sekolah</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('alamat_sekolah') is-invalid @enderror"
                                                id="alamat_sekolah" name="alamat_sekolah" placeholder="Alamat Sekolah"
                                                value="{{ $profil->alamat_sekolah }}" readonly>
                                            @error('alamat_sekolah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="form-group row">
                                        <label for="email_sekolah" class="col-sm-2 col-form-label">Email Sekolah</label>
                                        <div class="col-sm-10">
                                            <input type="email"
                                                class="form-control @error('email_sekolah') is-invalid @enderror"
                                                id="email_sekolah" name="email_sekolah" placeholder="Email Sekolah"
                                                value="{{ $profil->email_sekolah }}" readonly>
                                            @error('email_sekolah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="kontak_sekolah" class="col-sm-2 col-form-label">Kontak Sekolah</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('kontak_sekolah') is-invalid @enderror"
                                                id="kontak_sekolah" name="kontak_sekolah" placeholder="Kontak Sekolah"
                                                value="{{ $profil->kontak_sekolah }}" readonly>
                                            @error('kontak_sekolah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="website_sekolah" class="col-sm-2 col-form-label">Website Sekolah</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('website_sekolah') is-invalid @enderror" name="website_sekolah" id="website_sekolah"
                                                placeholder="Website Sekolah" value="{{ $profil->website_sekolah }}"
                                                readonly>
                                            @error('website_sekolah')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn btn-info edit">Edit</div>
                            <button type="submit" class="btn btn-success simpan" hidden>Simpan</button>
                            <div class="btn btn-danger float-right batal" hidden>Batal</div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        //Unlock the form and show simpan button when edit button is clicked
        $('.edit').click(function() {
            $('.form-control').removeAttr('readonly');
            $('.edit').attr('hidden', true);
            $('.simpan').removeAttr('hidden');
            $('.batal').removeAttr('hidden');
        });

        //Lock the form and hide simpan button when batal button is clicked
        $('.batal').click(function() {
            $('.form-control').attr('readonly', true);
            $('.edit').removeAttr('hidden');
            $('.simpan').attr('hidden', true);
            $('.batal').attr('hidden', true);
        });
    </script>
@stop
