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
                <h3 class="card-title">Detail Guru </h3>
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
                                ID Guru
                            </label>
                            <div class="input-group">
                                <input id="id" name="id" value="{{ $guru->id }}" class="form-control"
                                disabled>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="name" class="text-lightdark">
                                Nama Guru
                            </label>
                            <div class="input-group">
                                <input id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}"
                                class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="nip" class="text-lightdark">
                                NIP
                            </label>
                            <div class="input-group">
                                <input id="nip" name="nip" value="{{ $guru->nip }}"
                                class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12" id="kelas_before">
                            <label for="kelas_before" class="text-lightdark">
                                Kelas Perwalian
                            </label>
                            <div class="input-group">
                                <input id="kelas_before" name="kelas_before" 
                                @if ($guru_kelas===null)
                                value="" 
                                @else
                                value="{{ $guru_kelas->nama_kelas }}" 
                                @endif
                                class="form-control" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12" id="kelas" hidden>
                            <label for="kelas" class="form-label">Kelas Perwalian</label>
                            <select class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" data-placeholder="-pilih kelas perwalian-" style="width: 100%;">
                                <option selected disabled>-pilih kelas perwalian-</option>
                                @foreach ($kelas as $k)
                                <option value={{ $k->id }}>{{ $k->nama_kelas }}</option>
                                @endforeach
                                <option value="0">Bukan Wali Kelas</option>
                            </select>
                            @error('kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <x-adminlte-input name="created_at" type="text" value="{{ $guru->created_at }}"
                            label="Waktu Ditambahkan" fgroup-class="col-md-12" disabled>
                            
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-purple">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                            
                        </x-adminlte-input>
                        
                        <x-adminlte-input name="updated_at" type="text" value="{{ $guru->updated_at }}"
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
    //csrf token for ajax call
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
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
            $('#nama_guru').prop('disabled', false);
            $('#nip').prop('disabled', false);
            $('#kelas_before').prop('disabled', true);
            $('#kelas_before').prop('hidden', true);
            $('#kelas').prop('disabled', false);
            $('#kelas').prop('hidden', false);
            $('#simpan').prop('hidden', false);
            $('#edit').prop('hidden', true);
        });
        
        $('#simpan').click(function() {
            //ajax update data
            $.ajax({
                url: "{{ route('dataGuru.update', $guru->id) }}",
                type: 'PUT',
                data: {
                    nama_guru: $('#nama_guru').val(),
                    nip: $('#nip').val(),
                    kelas: $('#kelas').val(),
                },
                success: function(data) {
                    $('#nama_guru').prop('disabled', true);
                    $('#nip').prop('disabled', true);
                    $('#kelas_before').prop('disabled', false);
                    $('#kelas_before').prop('hidden', false);
                    $('#kelas').prop('disabled', true);
                    $('#kelas').prop('hidden', true);
                    $('#simpan').prop('hidden', true);
                    $('#edit').prop('hidden', false);
                    
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