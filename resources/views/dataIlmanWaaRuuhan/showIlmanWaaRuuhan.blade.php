@extends('adminlte::page')

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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Ilman Waa Ruuhan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('dataIlmanWaaRuuhan.show', $data_iwr) }}
            </ol>
        </div>
    </div>

@stop
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card card-dark">
                <div class="card-header border-transparent">
                    <h3 class="card-title pt-1">Detail Ilman Waa Ruuhan </h3>
                    <div class="card-tools">
                        <a href="{{ route('dataIlmanWaaRuuhan.index') }}" class="btn btn-sm btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <form id="form_ilman_waa_ruuhan">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6 border-right">
                                

                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        Kelas
                                    </label>
                                    <div class="input-group">
                                        <input id="kelas" name="kelas" value="{{ $data_iwr->kelas->nama_kelas }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="text-lightdark">
                                        Nama Pencapaian
                                    </label>
                                    <div class="input-group">
                                        <input id="pencapaian" name="pencapaian" value="{{ $data_iwr->pencapaian }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="guru_id">Pilih Guru</label>
                                    <select class="custom-select" name="guru_id"
                                        id="guru_id">
                                        <option selected disabled>-Guru-</option>
                                        @foreach ($data_guru as $g)
                                            <option value={{ $g->id }} {{ $g->id == $data_iwr->guru_id ? 'selected' : '' }}>
                                                {{ $g->nama_guru }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('guru_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group col-md-12">
                                <label class="text-lightdark">
                                    ID
                                </label>
                                <div class="input-group">
                                    <input id="id" name="id" value="{{ $data_iwr->id }}"
                                        class="form-control" disabled>
                                </div>
                            </div>

                            <x-adminlte-input name="created_at" type="text" value="{{ $data_iwr->created_at }}"
                                label="Waktu Ditambahkan" fgroup-class="col-md-12" disabled>

                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-green">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </x-slot>

                            </x-adminlte-input>

                            <x-adminlte-input name="updated_at" type="text" value="{{ $data_iwr->updated_at }}"
                                label="Waktu Diperbaharui" fgroup-class="col-md-12" disabled>

                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-gradient-green">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </x-slot>

                            </x-adminlte-input>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <x-adminlte-button id="edit" class="btn bg-gradient-green  edit" label="Edit Data"
                                    icon="fas fa fa-fw fa-edit" />
                                <x-adminlte-button id="simpan" class="btn bg-gradient-green  simpan" type="submit"
                                    label="Simpan Data" icon="fas fa fa-fw fa-save" />
                                <x-adminlte-button id="batal" class="btn bg-gradient-maroon cancel" label="Batal"
                                    icon="fas fa fa-fw fa-times" />
                </div>
            </form>
            </div>
        </div>
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

            $('#edit').show();
            $('#simpan').hide();
            $('#batal').hide();
            $('input').prop('disabled', true);
            $('select').prop('disabled', true);

            $('#form_ilman_waa_ruuhan').on('submit', function(e) {
                e.preventDefault();
                var $form = $(this); 
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', false);
                $('select').prop('disabled', false);
                let pencapaian = $('#pencapaian').val();
                let guru_id = $('#guru_id').val();
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                //var data = $form.serialize();
                $.ajax({
                    url: "{{ route('dataIlmanWaaRuuhan.update', $data_iwr->id) }}",
                    type: "PUT",
                    data: {
                        pencapaian: pencapaian,
                        
                        guru_id: guru_id,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diupdate',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('#form_ilman_waa_ruuhan').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_ilman_waa_ruuhan').find('.error').remove();

                            //send error to adminlte form
                            $.each(err.responseJSON.error, function(i, error) {
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
                                text: err.responseJSON.message,
                                icon: 'error',
                                position: 'center',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    }
                });
            });

            $('#edit').click(function() {
                $('#edit').hide();
                $('#simpan').show();
                $('#batal').show();
                $('input:not(#id, #kelas, #created_at, #updated_at)').prop('disabled', false);
                $('select').prop('disabled', false);

            });

            $('#batal').click(function() {
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
            });
        });
    </script>
@stop
        