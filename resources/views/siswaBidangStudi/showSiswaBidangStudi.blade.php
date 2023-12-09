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
            <h1 class="m-0">Nilai {{ $siswaBidangStudi->siswa->nama_siswa }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('siswaBidangStudi.show', $siswaBidangStudi) }}
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
                        <a href="{{ route('siswaBidangStudi.index') }}" class="btn btn-sm btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <form id="form_siswa_hadist">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6 border-right">
                            
                                <div class="form-group col-md-12">
                                    <label for="nilai_uh_1" class="text-lightdark">
                                        Nilai UH 1
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_uh_1" name="nilai_uh_1"
                                            value="{{ old('nilai_uh_1', $siswaBidangStudi->uh_1->nilai_angka) }}"
                                            class="form-control @error('nilai_uh_1') is-invalid @enderror" disabled>
                                        @error('nilai_uh_1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_uh_2" class="text-lightdark">
                                        Nilai UH 2
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_uh_2" name="nilai_uh_2"
                                            value="{{ old('nilai_uh_2', $siswaBidangStudi->uh_2->nilai_angka) }}"
                                            class="form-control @error('nilai_uh_2') is-invalid @enderror" disabled>
                                        @error('nilai_uh_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_uh_3" class="text-lightdark">
                                        Nilai UH 3
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_uh_3" name="nilai_uh_3"
                                            value="{{ old('nilai_uh_3', $siswaBidangStudi->uh_3->nilai_angka) }}"
                                            class="form-control @error('nilai_uh_3') is-invalid @enderror" disabled>
                                        @error('nilai_uh_3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_uh_4" class="text-lightdark">
                                        Nilai UH 4
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_uh_4" name="nilai_uh_4"
                                            value="{{ old('nilai_uh_4', $siswaBidangStudi->uh_4->nilai_angka) }}"
                                            class="form-control @error('nilai_uh_4') is-invalid @enderror" disabled>
                                        @error('nilai_uh_4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_tugas_1" class="text-lightdark">
                                        Nilai Tugas 1
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_tugas_1" name="nilai_tugas_1"
                                            value="{{ old('nilai_tugas_1', $siswaBidangStudi->tugas_1->nilai_angka) }}"
                                            class="form-control @error('nilai_tugas_1') is-invalid @enderror" disabled>
                                        @error('nilai_tugas_1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_tugas_2" class="text-lightdark">
                                        Nilai Tugas 2
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_tugas_2" name="nilai_tugas_2"
                                            value="{{ old('nilai_tugas_2', $siswaBidangStudi->tugas_2->nilai_angka) }}"
                                            class="form-control @error('nilai_tugas_2') is-invalid @enderror" disabled>
                                        @error('nilai_tugas_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_uts" class="text-lightdark">
                                        Nilai UTS
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_uts" name="nilai_uts"
                                            value="{{ old('nilai_uts', $siswaBidangStudi->uts->nilai_angka) }}"
                                            class="form-control @error('nilai_uts') is-invalid @enderror" disabled>
                                        @error('nilai_uts')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nilai_pas" class="text-lightdark">
                                        Nilai UAS
                                    </label>
                                    <div class="input-group">
                                        <input id="nilai_pas" name="nilai_pas"
                                            value="{{ old('nilai_pas', $siswaBidangStudi->pas->nilai_angka) }}"
                                            class="form-control @error('nilai_pas') is-invalid @enderror" disabled>
                                        @error('nilai_pas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group col-md-12">
                                <label for="name" class="text-lightdark">
                                    Nama Siswa
                                </label>
                                <div class="input-group">
                                    <input id="nama_siswa" name="nama_siswa"
                                        value="{{ $siswaBidangStudi->siswa->nama_siswa }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="text-lightdark">
                                    NIS
                                </label>
                                <div class="input-group">
                                    <input id="nisn" name="nisn" value="{{ $siswaBidangStudi->siswa->nisn }}"
                                        class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="kelas" class="text-lightdark">
                                    Kelas Siswa
                                </label>
                                <div class="input-group">
                                    <input id="kelas" name="kelas" value="{{ $siswaBidangStudi->siswa->sub_kelas->kelas->nama_kelas }} {{ $siswaBidangStudi->siswa->sub_kelas->nama_sub_kelas }}"
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

            $('#form_siswa_hadist').on('submit', function(e) {
                e.preventDefault();
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', true);
                var uh_1 = $('#nilai_uh_1').val();
                var uh_2 = $('#nilai_uh_2').val();
                var uh_3 = $('#nilai_uh_3').val();
                var uh_4 = $('#nilai_uh_4').val();
                var tugas_1 = $('#nilai_tugas_1').val();
                var tugas_2 = $('#nilai_tugas_2').val();
                var uts = $('#nilai_uts').val();
                var pas = $('#nilai_pas').val();

                $.ajax({
                    url: "{{ route('siswaBidangStudi.update', $siswaBidangStudi->id) }}",
                    type: "PATCH",
                    data: {
                        nilai_uh_1: uh_1,
                        nilai_uh_2: uh_2,
                        nilai_uh_3: uh_3,
                        nilai_uh_4: uh_4,
                        nilai_tugas_1: tugas_1,
                        nilai_tugas_2: tugas_2,
                        nilai_uts: uts,
                        nilai_pas: pas,
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
