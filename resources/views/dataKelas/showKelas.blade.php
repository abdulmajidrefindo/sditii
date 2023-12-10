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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Data Kelas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                {{ Breadcrumbs::render('dataKelas.show', $kelas) }}
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card card-dark">
                <div class="card-header border-transparent">
                    <h3 class="card-title pt-1">Detail Kelas </h3>
                    <div class="card-tools">
                        <!-- button to edit page-->

                        <a href="{{ route('dataKelas.index') }}" class="btn btn-sm btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form id="form_update_kelas">
                    @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6 border-right">
                            

                                <div class="form-group">
                                    <label for="kelas" class="form-label">Kelas Perwalian</label>
                                    <select class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                        name="kelas" data-placeholder="-pilih kelas perwalian-" style="width: 100%;">
                                        <option selected disabled>-Pilih Kelas Perwalian-</option>
                                        @foreach ($data_kelas as $k)
                                            <option value={{ $k->id }} @if ($k->id == $kelas->kelas_id) selected @endif>
                                                {{ $k->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nama_sub_kelas" class="form-label">Nama Sub Kelas</label>
                                    <input type="text" class="form-control @error('nama_sub_kelas') is-invalid @enderror"
                                        id="nama_sub_kelas" name="nama_sub_kelas" placeholder="Masukkan nama sub kelas"
                                        value="{{ $kelas->nama_sub_kelas }}" required>
                                    @error('nama_sub_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                    <select class="form-control @error('wali_kelas') is-invalid @enderror" id="wali_kelas"
                                        name="wali_kelas" data-placeholder="-pilih guru-" style="width: 100%;">
                                        <option value="0"><span class="text-red">---Belum Ada---</span></option>
                                        @foreach ($data_guru as $g)
                                            <option value={{ $g->id }} @if ($g->id == $kelas->guru_id) selected @endif>
                                                {{ $g->nama_guru }}</option>
                                        @endforeach

                                    </select>
                                    @error('wali_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- <x-adminlte-button id="edit" class="btn bg-gradient-green col-12 edit" label="Edit Data"
                                    icon="fas fa fa-fw fa-edit" />
                                <x-adminlte-button id="simpan" class="btn bg-gradient-green col-12 simpan" type="submit"
                                    label="Simpan Data" icon="fas fa fa-fw fa-save" />
                                <x-adminlte-button id="batal" class="btn bg-red col-12 cancel" label="Batal"
                                    icon="fas fa fa-fw fa-times" /> --}}
                            
                        </div>

                        <div class="col-sm-6 border-left d-flex align-items-center justify-content-center">
                            
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">

                            <x-adminlte-button id="edit" class="btn bg-gradient-green edit" label="Edit Data"
                                    icon="fas fa fa-fw fa-edit" />
                                <x-adminlte-button id="simpan" class="btn bg-gradient-green simpan" type="submit"
                                    label="Simpan Data" icon="fas fa fa-fw fa-save" />
                                <x-adminlte-button id="batal" class="btn bg-gradient-maroon cancel" label="Batal"
                                    icon="fas fa fa-fw fa-times" />
                        </div>
                    </div>
                </div>
            </form>
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
            $('input').prop('disabled', true);
            $('select').prop('disabled', true);
            $('#simpan').prop('hidden', true);
            $('#batal').prop('hidden', true);

            $('#edit').click(function() {
                $('input').prop('disabled', false);
                $('select').prop('disabled', false);
                $('#simpan').prop('hidden', false);
                $('#edit').prop('hidden', true);
                $('#batal').prop('hidden', false);
            });

            $('#batal').click(function() {
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                $('#simpan').prop('hidden', true);
                $('#edit').prop('hidden', false);
                $('#batal').prop('hidden', true);
            });

            $('#form_update_kelas').on('submit', function(e) {
                e.preventDefault();
                let kelas = $('#kelas').val();
                let nama_sub_kelas = $('#nama_sub_kelas').val();
                let wali_kelas = $('#wali_kelas').val();
                $('input').prop('disabled', true);
                $('select').prop('disabled', true);
                $('#simpan').prop('hidden', true);
                $('#edit').prop('hidden', false);
                $('#batal').prop('hidden', true);

                $.ajax({
                    type: "PUT",
                    url: "{{ route('dataKelas.update', $kelas->id) }}",
                    data: {
                        kelas: kelas,
                        nama_sub_kelas: nama_sub_kelas,
                        wali_kelas: wali_kelas,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        // if (response.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan!',
                            icon: 'success',
                            // iconColor: '#fff',
                            // toast: true,
                            // background: '#45FFCA',
                            position: 'top-center',
                            showConfirmButton: true,
                            timer: 3000,
                            timerProgressBar: true,

                        });
                    },
                    error: function(err) {

                        if (err.status == 422) {
                            $('#form_tambah_kelas').find(".is-invalid").removeClass(
                                "is-invalid");
                            $('#form_tambah_kelas').find('.error').remove();

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
                                // iconColor: '#fff',
                                toast: true,
                                // background: '#f8bb86',
                                position: 'top-center',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    }
                });
            });

        });
    </script>
@stop
