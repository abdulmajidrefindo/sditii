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
                            <form id="form_siswa_doa">
                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        NIS
                                    </label>
                                    <div class="input-group">
                                        <input id="nisn" name="nisn" value="{{ $siswaDoa->siswa->nisn }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="text-lightdark">
                                        Nama Siswa
                                    </label>
                                    <div class="input-group">
                                        <input id="nama_siswa" name="nama_siswa" value="{{ $siswaDoa->siswa->nama_siswa }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                @foreach ($siswaDoa->getAttributes() as $key => $value)
                                    @if (strpos($key, 'doa_') !== false)
                                        <div class="form-group col-md-12">
                                            <label for="{{ $key }}" class="text-lightdark">
                                                @if (strpos($key, 'doa_1') !== false)
                                                    Doa {{ $siswaDoa->doa_1->nama_nilai }}
                                                @elseif (strpos($key, 'doa_2') !== false)
                                                    Doa {{ $siswaDoa->doa_2->nama_nilai }}
                                                @elseif (strpos($key, 'doa_3') !== false)
                                                    Doa {{ $siswaDoa->doa_3->nama_nilai }}
                                                @elseif (strpos($key, 'doa_4') !== false)
                                                    Doa {{ $siswaDoa->doa_4->nama_nilai }}
                                                @elseif (strpos($key, 'doa_5') !== false)
                                                    Doa {{ $siswaDoa->doa_5->nama_nilai }}
                                                @elseif (strpos($key, 'doa_6') !== false)
                                                    Doa {{ $siswaDoa->doa_6->nama_nilai }}
                                                @elseif (strpos($key, 'doa_7') !== false)
                                                    Doa {{ $siswaDoa->doa_7->nama_nilai }}
                                                @elseif (strpos($key, 'doa_8') !== false)
                                                    Doa {{ $siswaDoa->doa_8->nama_nilai }}
                                                @elseif (strpos($key, 'doa_9') !== false)
                                                    Doa {{ $siswaDoa->doa_9->nama_nilai }}
                                                @endif
                                            </label>
                                            <div class="input-group">
                                                <input id="{{ $key }}" name="{{ $key }}"
                                                    value="{{ old($key, $value) }}"
                                                    class="form-control @error($key) is-invalid @enderror" disabled>
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

            $('#form_siswa_doa').on('submit', function(e) {
                e.preventDefault();
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', true);

                var nisn = $('#nisn').val();
                var doa_1 = $('#doa_1_id').val();
                var doa_2 = $('#doa_2_id').val();
                var doa_3 = $('#doa_3_id').val();
                var doa_4 = $('#doa_4_id').val();
                var doa_5 = $('#doa_5_id').val();
                var doa_6 = $('#doa_6_id').val();
                var doa_7 = $('#doa_7_id').val();
                var doa_8 = $('#doa_8_id').val();
                var doa_9 = $('#doa_9_id').val();

                $.ajax({
                    url: "{{ route('siswaDoa.update', $siswaDoa->id) }}",
                    type: "PATCH",
                    data: {
                        nisn: nisn,
                        doa_1_id: doa_1,
                        doa_2_id: doa_2,
                        doa_3_id: doa_3,
                        doa_4_id: doa_4,
                        doa_5_id: doa_5,
                        doa_6_id: doa_6,
                        doa_7_id: doa_7,
                        doa_8_id: doa_8,
                        doa_9_id: doa_9,
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
                $('input:not(#nisn, #nama_siswa)').prop('disabled', false);

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
        