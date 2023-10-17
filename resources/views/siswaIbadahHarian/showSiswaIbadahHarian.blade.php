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
                    <h3 class="card-title">Detail Ibadah Harian</h3>
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
                            <form id="form_ibadah_harian">

                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        NISN
                                    </label>
                                    <div class="input-group">
                                        <input id="nisn" name="nisn" value="{{ $siswaIbadahHarian->siswa->nisn }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        Nama Siswa
                                    </label>
                                    <div class="input-group">
                                        <input id="nama_siswa" name="nama_siswa"
                                            value="{{ $siswaIbadahHarian->siswa->nama_siswa }}" class="form-control" disabled>
                                    </div>
                                </div>
                                @foreach ($siswaIbadahHarian->getAttributes() as $key => $value)
                                    @if (strpos($key, 'ibadah_harian') !== false)
                                        <div class="form-group col-md-12">
                                            {{-- the key is ibadah_harian1_id--}}
                                            <label for="{{ $key }}" class="text-lightdark">
                                                {{ $siswaIbadahHarian->{substr($key, 0, -3)}->nama_kriteria }}
                                            </label>
                                            <div class="input-group">
                                                <select id="{{ $key }}" name="{{ $key }}" class="form-control @error($key) is-invalid @enderror" disabled>
                                                    <option value="">-- Pilih {{ $siswaIbadahHarian->{substr($key, 0, -3)}->nama_kriteria }} --</option>
                                                    @foreach ($penilaian_deskripsi as $deskripsi)
                                                        <option value="{{ $deskripsi->id }}" {{ $deskripsi->id == $siswaIbadahHarian->{substr($key, 0, -3)}->id ? 'selected' : '' }}>
                                                            {{ $deskripsi->keterangan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error($key)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

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

            $('#form_ibadah_harian').on('submit', function(e) {
                e.preventDefault();
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);

                var ibadah_harian_1 = $('#ibadah_harian_1_id').val();
                var ibadah_harian_2 = $('#ibadah_harian_2_id').val();
                var ibadah_harian_3 = $('#ibadah_harian_3_id').val();
                var ibadah_harian_4 = $('#ibadah_harian_4_id').val();
                var ibadah_harian_5 = $('#ibadah_harian_5_id').val();
                var ibadah_harian_6 = $('#ibadah_harian_6_id').val();
                var ibadah_harian_7 = $('#ibadah_harian_7_id').val();
                var ibadah_harian_8 = $('#ibadah_harian_8_id').val();
                var ibadah_harian_9 = $('#ibadah_harian_9_id').val();

                $.ajax({
                    url: "{{ route('siswaIbadahHarian.update', $siswaIbadahHarian->id) }}",
                    type: "PATCH",
                    data: {
                        ibadah_harian_1_id: ibadah_harian_1,
                        ibadah_harian_2_id: ibadah_harian_2,
                        ibadah_harian_3_id: ibadah_harian_3,
                        ibadah_harian_4_id: ibadah_harian_4,
                        ibadah_harian_5_id: ibadah_harian_5,
                        ibadah_harian_6_id: ibadah_harian_6,
                        ibadah_harian_7_id: ibadah_harian_7,
                        ibadah_harian_8_id: ibadah_harian_8,
                        ibadah_harian_9_id: ibadah_harian_9,
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
                            $('#form_ibadah_harian').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_ibadah_harian').find('.error').remove();

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
                $('input:not(#nama_siswa, #nisn)').prop('disabled', false);
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
