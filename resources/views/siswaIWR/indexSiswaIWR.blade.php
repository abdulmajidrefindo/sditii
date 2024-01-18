@extends('adminlte::page')

{{-- @section('title', 'Ilman Waa Ruuhan') --}}

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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Nilai Ilman Waa Ruuhan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('siswaIlmanWaaRuuhan') }}
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-tabs">
                    <div class="card-header p-0 pt-0 bg-gradient-green">
                        <ul class="nav nav-tabs" id="ibadahHarianTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="controller-tab-iwr-table" data-toggle="tab"
                                href="#content-tab-iwr-table" role="tab" aria-controls="content-tab-iwr-table"
                                aria-selected="true">Nilai Siswa</a>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="controller-tab-iwr-export-import" data-toggle="tab"
                                href="#content-tab-iwr-export-import" role="tab"
                                aria-controls="content-tab-iwr-export-import" aria-selected="false">Ekspor/Impor Nilai</a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="ibadahHarianTabContent">
                            <div class="tab-pane active show" id="content-tab-iwr-table" role="tabpanel"
                            aria-labelledby="controller-tab-iwr-table">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <form action="{{ url('/') }}/iwr" method="post">
                                            @csrf
                                            <label for="kelas">Pilih Kelas</label>
                                            <div class="input-group">
                                                <select class="custom-select" name="kelas_id" id="kelas_id">
                                                    <option selected disabled>-Kelas-</option>
                                                    @foreach ($data_sub_kelas as $k)
                                                    <option value={{ $k->id }}
                                                        @if ($kelas_aktif !== null && $k->id == $kelas_aktif->id) selected @endif>
                                                        {{ $k->nama_kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <x-adminlte-button type="submit"
                                                        class="btn bg-gradient-green d-inline"
                                                        icon="fas fa fa-fw fa-save" label="Pilih" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <th>NISN</th>
                                            <th>Kelas</th>
                                            <th>Pencapaian</th>
                                            <th>Jilid</th>
                                            <th>Halaman</th>
                                            <th>Nilai</th>
                                            <th>Pengajar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach ($siswa_i as $s)
                                    <tr>
                                        <td>{{ $s->siswa->nama_siswa }}</td>
                                        <td>{{ $s->siswa->nisn }}</td>
                                        <td>{{ $s->siswa->sub_kelas->kelas->nama_kelas . ' ' . $s->siswa->sub_kelas->nama_sub_kelas }}
                                        </td>
                                        <td>{{ $s->ilman_waa_ruuhan->pencapaian }}</td>
                                        <td>{{ $s->jilid }}</td>
                                        <td>{{ $s->halaman }}</td>
                                        <td>
                                            @if ($s->penilaian_huruf_angka->nilai_angka !== null)
                                            {{ $s->penilaian_huruf_angka->nilai_angka }} /
                                            {{ $s->penilaian_huruf_angka->nilai_huruf }}
                                            @else
                                            <span class="badge badge-danger">Kosong</span>
                                            @endif
                                        </td>
                                        <td>{{ $s->ilman_waa_ruuhan->guru->nama_guru }}</td>
                                        <td>
                                            <a href="{{ route('siswaIlmanWaaRuuhan.show', $s->id) }}"
                                                class="btn btn-sm btn-success mx-1 shadow detail"><i
                                                class="fas fa-sm fa-fw fa-eye"></i> Detail</a>
                                                <a href="javascript:void(0)" data-toggle="tooltip"
                                                data-id="{{ $s->id }}" data-original-title="Delete"
                                                class="btn btn-sm btn-danger mx-1 shadow delete"><i
                                                class="fas fa-sm fa-fw fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                
                                {{-- Tab export-import content --}}
                                <div class="tab-pane fade" id="content-tab-iwr-export-import" role="tabpanel"
                                aria-labelledby="controller-tab-iwr-export-import">
                                <div class="card-body">
                                    <div class="row">
                                        {{-- Export Siswa IWR --}}
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-gradient-green">
                                                    <h3 class="card-title">Ekspor Data Ilman Waa Ruuhan</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ url('/') }}/iwr/export_excel" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="kelas">Pilih Kelas</label>
                                                            <div class="input-group">
                                                                <select class="custom-select" name="sub_kelas_id"
                                                                id="sub_kelas_id">
                                                                <option selected disabled>-Kelas-</option>
                                                                @foreach ($data_sub_kelas as $k)
                                                                <option value={{ $k->id }}>
                                                                    {{ $k->nama_kelas }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append">
                                                                    <x-adminlte-button type="submit"
                                                                    class="btn bg-gradient-green d-inline"
                                                                    icon="fas fa fa-fw fa-save" label="Ekspor" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Export Siswa IWR end --}}
                                        
                                        {{-- Import Siswa IWR --}}
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-gradient-green">
                                                    <h3 class="card-title">Impor Data Ilman Waa Ruuhan</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ url('/') }}/iwr/import_excel"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <x-adminlte-input-file name="file_nilai_excel" igroup-size="md"
                                                    placeholder="Pilih file..." label="Pilih File Excel"
                                                    fgroup-class="col-md-12">
                                                    <x-slot name="appendSlot">
                                                        <x-adminlte-button label="Impor" type="submit"
                                                        class="btn bg-gradient-green" />
                                                    </x-slot>
                                                    <x-slot name="prependSlot">
                                                        <div class="input-group-text bg-gradient-green">
                                                            <i class="fas fa-upload"></i>
                                                        </div>
                                                    </x-slot>
                                                </x-adminlte-input-file>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Import Siswa IWR --}}
                            </div>
                        </div>
                        <div class=" d-flex justify-content-center">
                            <div class="alert alert-info alert-dismissible">
                                <div>
                                    <h5><i class="icon fas fa-info"></i>
                                        Cara impor data nilai dari file excel:
                                    </h5>
                                    1. Ekspor data nilai terbaru terlebih dahulu<br>2. Modifikasi file excel yang diekspor tersebut (hanya modifikasi nilai)<br>3. Pilih dan impor file excel yang sudah dimodifikasi</div>
                                </div>
                            </div>
                        </div>
                        {{-- Tab export-import content end --}}
                        
                    </div>
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
            //"buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
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
                    let url = '{{ route('siswaIlmanWaaRuuhan.destroy', ':id') }}';
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
            
            {{-- Logika Berkaitan Dengan Import --}}
            
            <script>
                $(document).ready(function() {
                    // Listen for changes in the file input, and update the text
                    // inside the span next to it accordingly
                    $('#file_nilai_excel').on('change', function() {
                        // Get the name of the file
                        var fileName = $(this).val().split('\\').pop();
                        
                        //get the file extension
                        var fileExtension = ['xls', 'xlsx'];
                        if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) ==
                        -1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'File harus berupa excel!',
                            });
                            $('#file_nilai_excel').val('');
                            $('#file_nilai_excel').next().text('Pilih File');
                        } else {
                            //replace the "Choose a file" label
                            $(this).next().text(fileName);
                        }
                    });
                    
                });
            </script>
            
            <script>
                //if theres upload_error, show sweet alert
                $(document).ready(function() {
                    var upload_error = {!! json_encode(session('upload_error')) !!};
                    if (upload_error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: upload_error,
                        });
                    }
                    
                    var upload_success = {!! json_encode(session('upload_success')) !!};
                    if (upload_success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: upload_success,
                        });
                    }
                });
            </script>
            
            @stop
            