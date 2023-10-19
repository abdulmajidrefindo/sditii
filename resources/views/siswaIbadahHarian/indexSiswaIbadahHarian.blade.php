@extends('adminlte::page')

{{-- @section('title', 'Data Siswa') --}}

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
        <h1 class="m-0">Data Guru</h1>
    </div>
    <div class="col-sm-6"> --}}
        {{-- <ol class="breadcrumb float-sm-right">
            {{ Breadcrumbs::render('merek') }}
        </ol> --}}
    {{-- </div>
</div> --}}
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel Ibadah Harian</h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
                @foreach($siswa_ih as $s)
                @if($loop->iteration<=1)
                <tr>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    {{-- <th>Nilai 1</th>
                    <th>Nilai 2</th>
                    <th>Nilai 3</th>
                    <th>Nilai 4</th>
                    <th>Nilai 5</th>
                    <th>Nilai 6</th>
                    <th>Nilai 7</th>
                    <th>Nilai 8</th> --}}
                    <th>{{ optional($s)->ibadah_harian_1->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_2->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_3->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_4->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_5->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_6->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_7->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_8->nama_kriteria }}</th>
                    <th>{{ optional($s)->ibadah_harian_9->nama_kriteria }}</th>
                    <th>Aksi</th>
                </tr>
                @endif
                @endforeach
            </thead>
                @forelse ($siswa_ih as $n)
                <tr>
                    <td>{{ $n->siswa->nama_siswa }}</td>
                    <td>{{ $n->siswa->nisn }}</td>
                    <td>{{ $n->siswa->kelas->nama_kelas }}</td>
                    <td>{{ optional($n)->ibadah_harian_1->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_2->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_3->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_4->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_5->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_6->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_7->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_8->nilai }}</td>
                    <td>{{ optional($n)->ibadah_harian_9->nilai }}</td>
                    <td>
                      <a href="{{ route('siswaIbadahHarian.show', $n->id) }}" class="btn btn-sm btn-success mx-1 shadow detail"><i class="fas fa-sm fa-fw fa-eye"></i> Detail</a>
                      <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$n->id}}" data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i class="fas fa-sm fa-fw fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                @empty
                <td>-</td>
                @endforelse
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

<script>
  //delete via ajax with sweet alert
  $(document).on('click', '.delete', function() {
      let id = $(this).attr('data-id');
      let url = '{{ route("siswaIbadahHarian.destroy", ":id") }}';
      url = url.replace(':id', id);
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            data: {
              method: '_DELETE',
              submit: true,
              _token: '{{ csrf_token() }}'
            },
            success: function(response) {
              if (response.status == 200) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: response.message,
                }).then(function() {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: response.error,
                });
              }
            },
            error: function(response) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: response.error,
              });
            }
          });
        }
      });
    });
</script>

@stop