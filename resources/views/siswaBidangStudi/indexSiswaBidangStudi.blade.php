@extends('adminlte::page')

{{-- @section('title', 'Bidang Studi') --}}

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
                        <h3 class="card-title">Tabel Bidang Studi</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="mapel">Pilih Mata Pelajaran</label>
                                <form action="{{ url('/') }}/bidangStudi" method="post">
                                    @csrf
                                    <select class="custom-select" name="mapel_id" id="mapel_id">
                                        <option selected disabled>-Mata Pelajaran-</option>
                                        @foreach ($data_mapel as $m)
                                            <option value={{ $m->id }}>{{ $m->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit">
                                </form>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Ulangan Harian 1</th>
                                    <th>Ulangan Harian 2</th>
                                    <th>Ulangan Harian 3</th>
                                    <th>Ulangan Harian 4</th>
                                    <th>Tugas 1</th>
                                    <th>Tugas 2</th>
                                    <th>UTS</th>
                                    <th>PAS</th>
                                    {{-- <th>Nilai Akhir</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($siswa_bs as $n)
                                <tr>
                                    <td>{{ $n->siswa->nama_siswa }}</td>
                                    <td>{{ $n->siswa->nisn }}</td>
                                    <td>{{ $n->siswa->kelas->nama_kelas }}</td>
                                    <td>{{ $n->uh_1->nilai_angka }}</td>
                                    <td>{{ $n->uh_2->nilai_angka }}</td>
                                    <td>{{ $n->uh_3->nilai_angka }}</td>
                                    <td>{{ $n->uh_4->nilai_angka }}</td>
                                    <td>{{ $n->tugas_1->nilai_angka }}</td>
                                    <td>{{ $n->tugas_2->nilai_angka }}</td>
                                    <td>{{ $n->uts->nilai_angka }}</td>
                                    <td>{{ $n->pas->nilai_angka }}</td>
                                    {{-- <td>{{ optional($n->nilai_akhir) }}</td> --}}

                                    <td>
                                        <a href="{{ route('siswaBidangStudi.show', $n->id) }}"
                                            class="btn btn-sm btn-success mx-1 shadow detail"><i
                                                class="fas fa-sm fa-fw fa-eye"></i> Detail</a>
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $n->id }}"
                                            data-original-title="Delete" class="btn btn-sm btn-danger mx-1 shadow delete"><i
                                                class="fas fa-sm fa-fw fa-trash"></i> Hapus</a>
                                    </td>

                                </tr>
                            @endforeach
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
    <script src={{ asset('public/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}>
    </script>
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
    <script type="text/javascript">
        $(function() {
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
            let url = '{{ route('siswaBidangStudi.destroy', ':id') }}';
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
