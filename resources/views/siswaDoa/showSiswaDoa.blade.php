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
            <h1 class="m-0">Nilai {{ $siswaDoa[0]->siswa->nama_siswa }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('siswaDoa.show', $siswaDoa[0]) }}
            </ol>
        </div>
    </div>

@stop
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card card-dark">
                <div class="card-header border-transparent">
                    <h3 class="card-title pt-1">Detail Siswa </h3>
                    <div class="card-tools">
                        <a href="{{ route('siswaDoa.index') }}" class="btn btn-sm btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <form id="form_siswa_doa">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6 border-right">
                                

                                @foreach ($siswaDoa as $siswa_d)
                                        <div class="form-group col-md-12">
                                            <label for="doa_{{ $siswa_d->id }}" class="text-lightdark">
                                                    {{ $siswa_d->doa_1->nama_nilai }}
                                            </label>
                                            <div class="input-group">
                                                <input id="doa_{{ $siswa_d->id }}" name="doa_{{ $siswa_d->id }}"
                                                    value="{{ old($siswa_d->id) ?? $siswa_d->penilaian_huruf_angka_id }}"
                                                    class="form-control @error($siswa_d->id) is-invalid @enderror">
                                                @error($siswa_d->id)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                @endforeach

                                
                            
                        </div>
                        <div class="col-sm-6">
                            

                            <div class="form-group col-md-12">
                                <label for="name" class="text-lightdark">
                                    Nama Siswa
                                </label>
                                <div class="input-group">
                                    <input id="nama_siswa" name="nama_siswa" value="{{ $siswaDoa[0]->siswa->nama_siswa }}"
                                        class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-lightdark">
                                    NIS
                                </label>
                                <div class="input-group">
                                    <input id="nisn" name="nisn" value="{{ $siswaDoa[0]->siswa->nisn }}"
                                        class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="kelas" class="text-lightdark">
                                    Kelas Siswa
                                </label>
                                <div class="input-group">
                                    <input id="kelas" name="kelas" value="{{ $siswaDoa[0]->siswa->sub_kelas->kelas->nama_kelas }} {{ $siswaDoa[0]->siswa->sub_kelas->nama_sub_kelas }}"
                                        class="form-control" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <x-adminlte-button id="edit" class="btn bg-gradient-green edit" label="Edit Data"
                                    icon="fas fa fa-fw fa-edit" />
                                <x-adminlte-button id="simpan" class="btn bg-gradient-green simpan" type="submit"
                                    label="Simpan Data" icon="fas fa fa-fw fa-save" />
                                <x-adminlte-button id="batal" class="btn bg-gradient-red cancel" label="Batal"
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
            $('#form_siswa_doa').on('submit', function(e) {
                e.preventDefault();
                var $form = $(this); 
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();

                var data = $form.serialize();
                $('input').prop('disabled', true);
                $.ajax({
                    url: "{{ route('siswaDoa.update', $siswaDoa[0]->siswa->id) }}",
                    type: "PATCH",
                    data: data,
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
                            $('#form_siswa_doa').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_siswa_doa').find('.error').remove();

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

            $('#edit').click(function() {
                $('#edit').hide();
                $('#simpan').show();
                $('#batal').show();
                $('input:not(#nisn, #nama_siswa, #kelas)').prop('disabled', false);

            });

            $('#batal').click(function() {
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', true);
            });
        });
    </script>
@stop
        