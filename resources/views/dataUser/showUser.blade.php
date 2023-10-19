@extends('adminlte::page')

{{-- @section('title', 'Data User') --}}

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
<!-- Select2 -->
<link rel="stylesheet" href="vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@stop
@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card card-dark">
            <div class="card-header border-transparent">
                <h3 class="card-title">Detail User </h3>
                <div class="card-tools">
                    <!-- button to edit page-->
                    
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="form-group col-md-12">
                            <label class="text-lightdark">
                                ID User
                            </label>
                            <div class="input-group">
                                <input id="id" name="id" value="{{ $user->id }}" class="form-control"
                                disabled>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="name" class="text-lightdark">
                                Nama
                            </label>
                            <div class="input-group">
                                <input id="name" name="name" value="{{ $user->name }}"
                                class="form-control" disabled>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group col-md-12">
                            <label for="user_name" class="text-lightdark">
                                Username
                            </label>
                            <div class="input-group">
                                <input id="user_name" name="user_name" value="{{ $user->user_name }}"
                                class="form-control" disabled>
                            </div>
                        </div> --}}
                        
                        <div class="form-group col-md-12">
                            <label for="email" class="text-lightdark">
                                Email
                            </label>
                            <div class="input-group">
                                <input id="email" name="email" value="{{ $user->email }}"
                                class="form-control" disabled>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" 
                            placeholder="-password disembunyikan-" value="{{ $user->password }}" disabled>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}
                        
                        <div class="form-group col-md-12" id="form_role">
                            <label for="role" class="text-lightdark">
                                Peran
                            </label>
                            <div class="input-group">
                                <input id="role" name="role" 
                                
                                value="@foreach ($userRole as $ur) {{ $ur->role->role }}, @endforeach" 
                                class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12" hidden id="form_update_role">
                            <label for="update_role" class="form-label">Peran</label>
                            <select class="form-control @error('update_role') is-invalid @enderror" id="update_role" name="update_role" data-placeholder="-pilih peran pengguna-" style="width: 100%;">
                                <option selected disabled>-pilih peran pengguna-</option>
                                <option value="1">Administrator</option>
                                <option value="3">Guru</option>
                            </select>
                            @error('update_role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <x-adminlte-input name="created_at" type="text" value="{{ $user->created_at }}"
                            label="Waktu Ditambahkan" fgroup-class="col-md-12" disabled>
                            
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-purple">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                            
                        </x-adminlte-input>
                        
                        <x-adminlte-input name="updated_at" type="text" value="{{ $user->updated_at }}"
                            label="Waktu Diperbaharui" fgroup-class="col-md-12" disabled>
                            
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-purple">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                            
                        </x-adminlte-input>
                        
                        <x-adminlte-button id="simpan" class="btn bg-purple col-12 simpan" type="submit" label="Simpan Data"
                        icon="fas fa fa-fw fa-save" hidden />
                        
                        <x-adminlte-button id="edit" class="btn bg-purple col-12 edit" type="submit" label="Edit Data"
                        icon="fas fa fa-fw fa-edit" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12 col-sm-12 col-md-8">
        <div class="card card-dark">
            <div class="card-header border-transparent" role="button" data-card-widget="collapse">
                <h3 class="card-title">Daftar Transaksi {{ $pemasok->nama_pemasok }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabel-transaksi" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> --}}
</div>  
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
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('#edit').click(function() {
            $('#name').prop('disabled', false);
            // $('#user_name').prop('disabled', false);
            $('#email').prop('disabled', false);
            // $('#password').prop('disabled', false);
            // $('#password').prop('placeholder', '-masukkan password baru-');
            $('#form_role').prop('disabled', true);
            $('#form_role').prop('hidden', true);
            $('#update_role').prop('disabled', false);
            $('#form_update_role').prop('disabled', false);
            $('#form_update_role').prop('hidden', false);
            $('#simpan').prop('hidden', false);
            $('#edit').prop('hidden', true);
            
        });
        
        $('#simpan').click(function() {
            //ajax update data
            $.ajax({
                url: "{{ route('dataUser.update', $user->id) }}",
                type: 'PUT',
                data: {
                    name: $('#name').val(),
                    // user_name: $('#user_name').val(),
                    email: $('#email').val(),
                    // password: $('#password').val(),
                    role: $('#update_role').val(),
                    
                    
                },
                success: function(data) {
                    $('#name').prop('disabled', true);
                    // $('#user_name').prop('disabled', true);
                    $('#email').prop('disabled', true);
                    // $('#password').prop('disabled', true);
                    // $('#password').prop('placeholder', '-password disembunyikan-');
                    $('#role').prop('disabled', true);
                    $('#form_role').prop('hidden', false);
                    $('#form_update_role').prop('hidden', true);
                    $('#update_role').prop('disabled', true);
                    $('#simpan').prop('hidden', true);
                    $('#edit').prop('hidden', false);
                    // role select the value
                    var role = $('#update_role').val();
                    var roleText = $('#update_role option:selected').text();
                    $('#role').val(roleText);

                    
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diperbaharui',
                    });
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data gagal diperbaharui',
                    });
                }
            });
            
            // set updated_at with now
            var now = new Date();
            var date = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
            var time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
            var dateTime = date + ' ' + time;
            // var dateTime = now();
            $('#updated_at').val(dateTime);
            
        });
        
    });
</script>
@stop