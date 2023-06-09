@extends('adminlte::page')

@section('title', 'Rapor Siswa')

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
        <div class="card-header">
            <h3 class="card-title">Daftar Rapor Siswa</h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                </tr>
            </thead>
            @foreach ($data_siswa as $i)
                <tr>
                    <td>{{ $i->nama_siswa }}</td>
                    <td>{{ $i->nisn }}</td>
                    <td>{{ $i->kelas->nama_kelas }}</td>
                    <td>{{ $i->kelas->guru->nama_guru }}</td>
                </tr>
            @endforeach
          </table>
        </div>
      </div>
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
    </div>
  </div>
</div>
@stop
@section('head_js')
<!-- jQuery -->
{{-- <script type="text/javascript"  src={{ asset('vendor/jquery/jquery.min.js') }}></script> --}}

<!-- Bootstrap 4 -->
<script type="text/javascript"  src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
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
{{--sendiri, versi lama--}}{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--sendiri--}}{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script> --}}

<!-- AdminLTE App -->
{{-- <script src="vendor/adminlte/dist/js/adminlte.min.js"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src={{ asset('public/AdminLTE-3.2.0/dist/js/demo.js') }}></script> --}}
<!-- Page specific script -->
@stop
@section('js')
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": false,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
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
@stop