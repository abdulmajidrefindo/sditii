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
            <div class="card-header">
              <h3 class="card-title">Rapor Siswa</h3>
            </div>
            <div class="card-body">
              <div class="col-sm-6">
                <div class="form-group">
                  {{-- <label for="kelas">Pilih Kelas</label>
                  <form action="{{ url('/') }}/raporSiswa" method="post">
                    @csrf
                    <select class="custom-select" name="kelas_id" id="kelas_id">
                      @foreach ($data_kelas as $k)
                      <option value={{ $k->id }}>{{ $k->nama_kelas }}</option>
                      @endforeach
                    </select>
                    <input type="submit">
                  </form> --}}
                </div>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                @forelse ($data_siswa as $s)
                <tr>
                  <td>{{ $s->nama_siswa }}</td>
                  <td>{{ $s->nisn }}</td>
                  <td>{{ $s->kelas->nama_kelas }}</td>
                  <td>{{ $s->kelas->guru->nama_guru }}</td>
                  <td>
                    <a href="{{ url('/') }}/raporSiswa/{{ $s->id }}/detail" class="btn btn-block btn-primary">Detail</a>
                    <a href="{{ url('/') }}/raporSiswa/{{ $s->id }}/print" class="btn btn-block btn-primary">Print</a>
                  </td>
                </tr>
                @empty
                <td>-</td>
                @endforelse
              </table>
            </div>
            {{-- <div class="input-group input-group-sm">
              <input type="text" class="form-control">
              <span class="input-group-append">
                <button type="button" class="btn btn-info btn-flat">Go!</button>
              </span>
            </div> --}}
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
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ['colvis'],
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