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
                    <h3 class="card-title">Detail Bidang Studi </h3>
                    <div class="card-tools">
                        <!-- button to edit page-->

                        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button> --}}
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <form id="form_bidang_studi">
                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        ID
                                    </label>
                                    <div class="input-group">
                                        <input id="id" name="id" value="{{ $data_bidang_studi->id }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="text-lightdark">
                                        Periode
                                    </label>
                                    <div class="input-group">
                                        <input id="periode" name="periode" value="{{ $data_bidang_studi->periode->semester == 1 ? 'Ganjil' : 'Genap' }} - {{ $data_bidang_studi->periode->tahun_ajaran }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name" class="text-lightdark">
                                        Nama Nilai
                                    </label>
                                    <div class="input-group">
                                        <input id="nama_mapel" name="nama_mapel" value="{{ $data_bidang_studi->nama_mapel }}"
                                            class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="kelas_id">Pilih Kelas</label>
                                    <select class="custom-select" name="kelas_id"
                                        id="kelas_id">
                                        <option selected disabled>-Kelas-</option>
                                        @foreach ($data_kelas as $k)
                                            <option value={{ $k->id }} {{ $k->id == $data_bidang_studi->kelas_id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="guru_id">Pilih Guru</label>
                                    <select class="custom-select" name="guru_id"
                                        id="guru_id">
                                        <option selected disabled>-Guru-</option>
                                        @foreach ($data_guru as $g)
                                            <option value={{ $g->id }} {{ $g->id == $data_bidang_studi->guru_id ? 'selected' : '' }}>
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
            $('input').prop('disabled', true);
            $('select').prop('disabled', true);

            $('#form_bidang_studi').on('submit', function(e) {
                e.preventDefault();
                var $form = $(this); 
                $('#edit').show();
                $('#simpan').hide();
                $('#batal').hide();
                $('input').prop('disabled', false);
                $('select').prop('disabled', false);
                let nama_mapel = $('#nama_mapel').val();
                let kelas_id = $('#kelas_id').val();
                let guru_id = $('#guru_id').val();
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                //var data = $form.serialize();
                $.ajax({
                    url: "{{ route('dataBidangStudi.update', $data_bidang_studi->id) }}",
                    type: "PUT",
                    data: {
                        nama_mapel: nama_mapel,
                        kelas_id: kelas_id,
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
                            $('#form_bidang_studi').find('.is-invalid').removeClass(
                                'is-invalid');
                            $('#form_bidang_studi').find('.error').remove();

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
                $('input:not(#id, #periode)').prop('disabled', false);
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
        