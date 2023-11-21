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

    {{-- <div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0">Rapor Siswa</h1>
  </div>
  <div class="col-sm-6">
    {{-- <ol class="breadcrumb float-sm-right">
      {{ Breadcrumbs::render('merek') }}
    </ol> --}}
    {{-- </div> --}}
    {{-- </div>  --}}
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title"><b>Rapor Siswa</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="form-group row">
                                    <label for="nama_siswa" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <div class="form-control form-control-border" id="nama_siswa">
                                            {{ $data_siswa->nama_siswa }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nisn_siswa" class="col-sm-4 col-form-label">NISN</label>
                                    <div class="col-sm-8">
                                        <div class="form-control form-control-border" id="nisn_siswa">
                                            {{ $data_siswa->nisn }}
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="kelas_siswa" class="col-sm-4 col-form-label">Kelas</label>
                                    <div class="col-sm-8">
                                        <div class="form-control form-control-border" id="kelas_siswa">
                                            {{ $data_siswa->kelas->nama_kelas }}
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="semester_siswa" class="col-sm-4 col-form-label">Semester</label>
                                    <div class="col-sm-8">
                                        <div class="form-control form-control-border" id="semester_siswa">
                                            {{
                                            $periode->semester == 1 ? '1 (Ganjil)' : '2 (Genap)' 
                                            }}
    
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="tahun_ajaran_siswa" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                    <div class="col-sm-8">
                                        <div class="form-control form-control-border" id="tahun_ajaran_siswa">
                                            {{ $periode->tahun_ajaran }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
    
                                <div class="form-group row">
                                    <label for="tahun_ajaran_siswa" class="col-sm-3 col-form-label pl-4">Keterangan</label>
                                    <div class="col-sm-4 border-right">
                                        <div class="pt-2">
                                            A+ (91-100) <br>
                                        </div>
                                        <div class="pt-3">
                                            A &nbsp; (86-90) <br>
                                        </div>
                                        <div class="pt-3">
                                            B+ (81-85) <br>
                                        </div>
                                        <div class="pt-3">
                                            B &nbsp; (76-80) <br>
                                        </div>
                                        <div class="pt-3">
                                            B- (71-75) <br>
                                        </div>
                                        <div class="pt-3">
                                            C+ (66-70) <br>
                                        </div>
                                        
                                    </div>

                                    <div class="col-sm-5 pl-4">
                                        <div class="pt-2">
                                            BT : Belum Terlihat <br>
                                        </div>
                                        <div class="pt-3">
                                            MT : Mulai Terlihat <br>
                                        </div>
                                        <div class="pt-3">
                                            MB : Mulai Berkembang <br>
                                        </div>
                                        <div class="pt-3">
                                            MK : Menjadi Kebiasaan <br>
                                        </div>
                                    </div>
                                </div>
    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title">Ilman Waa Ruuhan </h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Pencapaian</th>
                                    <th>Jilid/Surah</th>
                                    <th>Halaman/Ayat</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_iwr as $n)
                                    <tr>
                                        <td>{{ $n->ilman_waa_ruuhan->pencapaian }}</td>
                                        <td>{{ $n->ilman_waa_ruuhan->jilid }}</td>
                                        <td>{{ $n->ilman_waa_ruuhan->halaman }}</td>
                                        <td>{{ $n->penilaian_deskripsi->deskripsi }} / {{ $n->penilaian_deskripsi->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title">Bidang Studi </h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center pr-4" style="width: 10px">No</th>
                                    <th rowspan="2" class="align-middle text-center">Mata Pelajaran</th>
                                    <th colspan="2" class="text-center">Nilai Prestasi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Angka</th>
                                    <th class="text-center">Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_mapel as $n)
                                    <tr>
                                        <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                        <td>{{ $n->mapel->nama_mapel }}</td>
                                        <td class="text-center">{{ $n->nilai_akhir }}</td>
                                        <td class="text-center">{{ $n->nilai_huruf }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                
                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title">Ibadah Harian</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center pr-4" width= "10px">No</th>
                                    <th class="text-center" width="300px">Kriteria</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_ih as $n)
                                    <tr>
                                        <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                        <td>{{ $n->ibadah_harian_1->nama_kriteria }}</td>
                                        <td class="text-center">{{ $n->penilaian_deskripsi->deskripsi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title">Tahfidz</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center pr-4" width= "10px">No</th>
                                    <th rowspan="2" class="align-middle text-center" width="300px">Nama</th>
                                    <th colspan="2" class="text-center">Nilai</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Angka</th>
                                    <th class="text-center">Huruf</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_t as $n)
                                    <tr>
                                        <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                        <td>{{ $n->tahfidz_1->nama_nilai }}</td>
                                        <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_angka }}</td>
                                        <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_huruf }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title">Hadist</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center pr-4" width= "10px">No</th>
                                    <th rowspan="2" class="align-middle text-center" width="300px">Nama</th>
                                    <th colspan="2" class="text-center">Nilai</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Angka</th>
                                    <th class="text-center">Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_h as $n)
                                    <tr>
                                        <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                        <td>{{ $n->hadist_1->nama_nilai }}</td>
                                        <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_angka }}</td>
                                        <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_huruf }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-gradient-green">
                        <h3 class="card-title">Doa</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center pr-4" width= "10px">No</th>
                                    <th rowspan="2" class="align-middle text-center" width="300px">Nama</th>
                                    <th colspan="2" class="text-center">Nilai</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Angka</th>
                                    <th class="text-center">Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_d as $n)
                                    <tr>
                                        <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                        <td>{{ $n->doa_1->nama_nilai }}</td>
                                        <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_angka }}</td>
                                        <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_huruf }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
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

@stop
