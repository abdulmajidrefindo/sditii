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
            <h1 class="m-0">Data Tahun Pelajaran</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('dataPeriode.show', $dataPeriode) }}
            </ol>
        </div>
    </div>

@stop
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card card-dark">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Detail Periode </h3>
                    <div class="card-tools">
                        <!-- button to edit page-->

                        <a href="{{ route('dataPeriode.index') }}" class="btn btn-sm btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form id="form_periode">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6 border-right">



                                <div class="form-group col-md-12">
                                    <label for="semester" class="text-lightdark">
                                        Semester
                                    </label>
                                    <div class="input-group">
                                        <input id="semester" name="semester" value="{{ $dataPeriode->semester }}"
                                            class="form-control @error('semester') is-invalid @enderror" disabled>
                                        @error('semester')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="tahun_ajaran" class="text-lightdark">
                                        Tahun Ajaran
                                    </label>
                                    <div class="input-group">
                                        <input id="tahun_ajaran" name="tahun_ajaran"
                                            value="{{ $dataPeriode->tahun_ajaran }}"
                                            class="form-control @error('tahun_ajaran') is-invalid @enderror" disabled>
                                        @error('tahun_ajaran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">

                                    <label for="status" class="text-lightdark">
                                        Status
                                    </label>
                                    @if ($dataPeriode->status == 'aktif')
                                        <div class="input-group">
                                            <div id="status" name="status" class="form-control">
                                                Aktif
                                            </div>
                                        </div>
                                    @else
                                        <div class="custom-control custom-checkbox pt-2">
                                            <input class="custom-control-input" type="checkbox" id="status"
                                                type="checkbox" value="aktif" name="status"
                                                {{ $dataPeriode->status == 'aktif' ? 'checked' : '' }} disabled>
                                            <label for="status" class="custom-control-label">Atur Sebagai Semester
                                                Aktif</label>
                                        </div>

                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        ID Periode
                                    </label>
                                    <div class="input-group">
                                        <input id="id" name="id" value="{{ $dataPeriode->id }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <x-adminlte-input name="created_at" type="text" value="{{ $dataPeriode->created_at }}"
                                    label="Waktu Ditambahkan" fgroup-class="col-md-12" disabled>

                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-green">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>

                                </x-adminlte-input>

                                <x-adminlte-input name="updated_at" type="text" value="{{ $dataPeriode->updated_at }}"
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
                        <x-adminlte-button id="edit" class="btn bg-gradient-green edit" label="Edit Data"
                            icon="fas fa fa-fw fa-edit" />
                        <x-adminlte-button id="simpan" class="btn bg-gradient-green simpan" type="submit"
                            label="Simpan Data" icon="fas fa fa-fw fa-save" hidden />
                        <x-adminlte-button id="batal" class="btn bg-gradient-maroon cancel" label="Batal"
                            icon="fas fa fa-fw fa-times" hidden />
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
                $('#semester').prop('disabled', false);
                $('#tahun_ajaran').prop('disabled', false);
                $('#status').prop('disabled', false);
                $('#simpan').prop('hidden', false);
                $('#edit').prop('hidden', true);
                $('#batal').prop('hidden', false);
            });

            $('#batal').click(function() {
                $('#semester').prop('disabled', true);
                $('#tahun_ajaran').prop('disabled', true);
                $('#status').prop('disabled', true);
                $('#simpan').prop('hidden', true);
                $('#edit').prop('hidden', false);
                $('#batal').prop('hidden', true);
            });

            $('#simpan').click(function() {
                event.preventDefault();
                //ajax update data
                var status = $('#status').is(':checked') ? 'aktif' : 'tidak aktif';
                $.ajax({
                    url: "{{ route('dataPeriode.update', $dataPeriode->id) }}",
                    type: 'PUT',
                    data: {
                        semester: $('#semester').val(),
                        tahun_ajaran: $('#tahun_ajaran').val(),
                        status: status,
                    },
                    success: function(data) {
                        $('#semester').prop('disabled', true);
                        $('#tahun_ajaran').prop('disabled', true);
                        $('#status').prop('disabled', true);
                        $('#simpan').prop('hidden', true);
                        $('#edit').prop('hidden', false);
                        $('#batal').prop('hidden', true);

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil diperbaharui',
                        });
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('#form_periode').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_periode').find('.error').remove();

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
