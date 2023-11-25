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
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6">
            <div class="card card-dark">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Detail Siswa </h3>
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
                            <form id="form_siswa_hadist">
                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        NIS
                                    </label>
                                    <div class="input-group">
                                        <input id="nisn" name="nisn" value="{{ $siswaIlmanWaaRuuhan->siswa->nisn }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="text-lightdark">
                                        Nama Siswa
                                    </label>
                                    <div class="input-group">
                                        <input id="nama_siswa" name="nama_siswa"
                                            value="{{ $siswaIlmanWaaRuuhan->siswa->nama_siswa }}" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ilman_waa_ruuhan_jilid" class="text-lightdark">
                                        Jilid
                                    </label>
                                    <div class="input-group">
                                        <input id="ilman_waa_ruuhan_jilid" name="ilman_waa_ruuhan_jilid"
                                            value="{{ old('ilman_waa_ruuhan_jilid', $siswaIlmanWaaRuuhan->jilid) }}"
                                            class="form-control @error('ilman_waa_ruuhan_jilid') is-invalid @enderror" disabled>
                                        @error('ilman_waa_ruuhan_jilid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ilman_waa_ruuhan_halaman" class="text-lightdark">
                                        Halaman
                                    </label>
                                    <div class="input-group">
                                        <input id="ilman_waa_ruuhan_halaman" name="ilman_waa_ruuhan_halaman"
                                            value="{{ old('ilman_waa_ruuhan_halaman', $siswaIlmanWaaRuuhan->halaman) }}"
                                            class="form-control @error('ilman_waa_ruuhan_halaman') is-invalid @enderror" disabled>
                                        @error('ilman_waa_ruuhan_halaman')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ilman_waa_ruuhan_nilai" class="text-lightdark">
                                        Nilai
                                    </label>
                                    <div class="input-group">
                                        <select id="ilman_waa_ruuhan_nilai" name="ilman_waa_ruuhan_nilai"
                                            class="form-control @error('ilman_waa_ruuhan_nilai') is-invalid @enderror" disabled>
                                            @foreach ($penilaian_deskripsi as $deskripsi)
                                                <option value="{{ $deskripsi->id }}"
                                                    {{ old('ilman_waa_ruuhan_nilai', $siswaIlmanWaaRuuhan->penilaian_deskripsi->keterangan) == $deskripsi->keterangan ? 'selected' : '' }}>
                                                    {{ $deskripsi->keterangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ilman_waa_ruuhan_nilai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <x-adminlte-button id="edit" class="btn bg-purple col-12 edit" label="Edit Data"
                                    icon="fas fa fa-fw fa-edit" />
                                <x-adminlte-button id="simpan" class="btn bg-purple col-12 simpan" type="submit"
                                    label="Simpan Data" icon="fas fa fa-fw fa-save" />
                                <x-adminlte-button id="batal" class="btn bg-red col-12 cancel" label="Batal"
                                    icon="fas fa fa-fw fa-times" />
                            </form>
                        </div>
                    </div>
                </div>
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

            $('#form_siswa_hadist').on('submit', function(e) {
                e.preventDefault();
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                var ilman_waa_ruuhan_jilid = $('#ilman_waa_ruuhan_jilid').val();
                var ilman_waa_ruuhan_halaman = $('#ilman_waa_ruuhan_halaman').val();
                var ilman_waa_ruuhan_nilai = $('#ilman_waa_ruuhan_nilai').val();

                $.ajax({
                    url: "{{ route('siswaIlmanWaaRuuhan.update', $siswaIlmanWaaRuuhan->id) }}",
                    type: "PATCH",
                    data: {
                        ilman_waa_ruuhan_jilid: ilman_waa_ruuhan_jilid,
                        ilman_waa_ruuhan_halaman: ilman_waa_ruuhan_halaman,
                        ilman_waa_ruuhan_nilai: ilman_waa_ruuhan_nilai,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diupdate',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                        
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('#form_siswa_hadist').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_siswa_hadist').find('.error').remove();

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
                            console.log(err.responseJSON.error);
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
                $('input:not(#nisn, #nama_siswa, #ilman_waa_ruuhan_nilai)').prop('disabled', false);
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
