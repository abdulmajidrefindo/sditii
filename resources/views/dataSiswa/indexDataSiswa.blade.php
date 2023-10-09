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
    <h1 class="m-0">Data Siswa</h1>
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
              <h3 class="card-title">Tabel Siswa</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Orang Tua/Wali</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                    {{-- <th>Wali Kelas</th> --}}
                  </tr>
                </thead>
                {{-- @forelse ($siswa as $s)
                <tr>
                  <td>{{ $s->id }}</td>
                  <td>{{ $s->nama_siswa }}</td>
                  <td>{{ $s->nisn }}</td>
                  <td>{{ $s->orangtua_wali }}</td>
                  <td>{{ $s->kelas->nama_kelas }}</td>
                  <td>{{ $s->kelas->guru->nama_guru }}</td>
                </tr>
                @empty
                <td>-</td>
                @endforelse --}}
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
    <script>
      $(document).ready(function() {
        //set csrf token
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      });
      
      function resetForm() {
        $('#form_tambah_siswa').reset();
        $('#form_tambah_siswa').find('.is-invalid').removeClass('is-invalid');
        $('#form_tambah_siswa').find('.error').remove();
      }
    </script>
    <script>
      $(document).ready(function () {
        //DataTable
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "buttons": ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
          "paging": true,
          "searching": true,
          "ordering": true,
          "info": true,
          processing: true,
          serverSide: true,
          width: '100%',
          ajax: {
            url: "{{ route('siswa.getTable') }}",
            type: 'GET',
          },
          columns: [
          {
            data: 'id',
            name: 'id',
            sClass: 'text-center',
            width: '5%'
          },
          {
            data: 'nama_siswa',
            name: 'nama_siswa'
          },
          {
            data: 'nisn',
            name: 'nisn'
          },
          {
            data: 'orangtua_wali',
            name: 'orangtua_wali'
          },
          {
            data: 'nama_kelas',
            name: 'nama_kelas'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            sClass: 'text-center',
            width: '25%',
          }
          ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //Initialize Select2 Elements
      });
    </script>
    
    {{-- ajax tambah guru --}}
    {{-- <script>
      $(document).ready(function() {
        $('.select2').select2();
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
        $('#controller-tab-guru-add').on('click', function() {
          $('#form_tambah_guru')[0].reset();
        });
        $('#form_tambah_guru').on('submit', function(e) {
          e.preventDefault();
          let user = $('#user').val();
          let user_name = $('#user_name').val();
          let nip = $('#nip').val();  
          $.ajax({
            type: "POST",
            url: "{{ route('dataGuru.store') }}",
            data: {
              user: user,
              user_name: user_name,
              nip: nip,
            },
            dataType: "JSON",
            success: function(response) {
              // if (response.success) {
                $('#example1').DataTable().ajax.reload();
                $('#form_tambah_guru')[0].reset();
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Data berhasil disimpan!',
                  icon: 'success',
                  iconColor: '#fff',
                  toast: true,
                  background: '#45FFCA',
                  position: 'top-center',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                });
              },
              error: function(err) {
                
                if (err.status == 422) {
                  $('#form_tambah_guru').find(".is-invalid").removeClass(
                  "is-invalid");
                  $('#form_tambah_guru').find('.error').remove();
                  
                  //send error to adminlte form
                  $.each(err.responseJSON.errors, function(i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    if (el.hasClass('is-invalid')) {
                      el.removeClass('is-invalid');
                      el.next().remove();
                    }
                    el.addClass('is-invalid');
                    el.after($('<span class="error invalid-feedback">' +
                      error[0] + '</span>'));
                    });
                    Swal.fire({
                      title: 'Gagal!',
                      text: 'Mohon isi data dengan benar!',
                      icon: 'error',
                      iconColor: '#fff',
                      toast: true,
                      background: '#f8bb86',
                      position: 'top-center',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                    });
                  }
                }
              });
            });
          });
        </script> --}}
        
        <script>
          //delete via ajax
          $(document).on('click', '.delete', function() {
            let id = $(this).attr('data-id');
            Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Data yang dihapus tak dapat dikembalikan!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus!',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('dataGuru.index') }}" + "/" + id,
                  success: function(response) {
                    if (response.success != null) {
                      $('#example1').DataTable().ajax.reload();
                      Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data Berhasil Dihapus',
                        icon: 'success',
                        iconColor: '#fff',
                        color: '#fff',
                        toast: true,
                        background: '#8D72E1',
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                      });
                    } else {
                      Swal.fire({
                        title: 'Gagal!',
                        text: 'Data Gagal Dihapus',
                        icon: 'error',
                        iconColor: '#fff',
                        toast: true,
                        background: '#f8bb86',
                        position: 'center-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                      });
                    }
                  }
                });
              }
            });
          });
        </script>
        @stop