<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaIbadahHarianController;
use App\Http\Controllers\SiswaTahfidzController;
use App\Http\Controllers\SiswaHadistController;
use App\Http\Controllers\SiswaDoaController;
use App\Http\Controllers\SiswaIlmanWaaRuuhanController;
use App\Http\Controllers\SiswaBidangStudiController;
use App\Http\Controllers\RaporSiswaController;
use App\Http\Controllers\KelasController;

use App\Http\Controllers\DoaController;
use App\Http\Controllers\HadistController;
use App\Http\Controllers\TahfidzController;
use App\Http\Controllers\IbadahHarianController;
use App\Http\Controllers\BidangStudiController;
use App\Http\Controllers\IlmanWaaRuuhanController;

use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::post('/dataUser', UserController::class, 'edit');
// Route::get('/dataUser', UserController::class, 'edit');

Route::middleware('auth')->group(function () {

    Route::resource('/dataGuru', GuruController::class);
    Route::resource('/dataKelas', KelasController::class)->parameters([
        'dataKelas' => 'kelas'
    ]);
    Route::resource('/dataUser', UserController::class)->middleware('role:Wali Kelas,Administrator');
    Route::get('/dataUser/export_excel/{sub_kelas_id}', [UserController::class, 'export_excel'])->name('user.export_excel');
    Route::post('/dataUser/export_excel', [UserController::class, 'export_excel'])->name('user.export_excel');
    Route::post('/dataUser/import_excel', [UserController::class, 'import_excel'])->name('user.import_excel');

    Route::post('/dataSiswaKelas', [SiswaController::class, 'index']);
    Route::resource('/dataPeriode', PeriodeController::class);

    Route::get('/getTableUser', [UserController::class, 'getTable'])->name('user.getTable');
    Route::get('/getTableGuru', [GuruController::class, 'getTable'])->name('guru.getTable');
    Route::get('/getTablePeriode', [PeriodeController::class, 'getTable'])->name('periode.getTable');
    Route::get('/getTableKelas', [KelasController::class, 'getTable'])->name('kelas.getTable');
    
    Route::resource('/dataSiswa', SiswaController::class);
    Route::get('/getTableSiswa', [SiswaController::class, 'getTable'])->name('siswa.getTable');
    Route::get('/siswa/export_excel/{sub_kelas_id}', [SiswaController::class, 'export_excel'])->name('siswa.export_excel');
    Route::post('/siswa/export_excel', [SiswaController::class, 'export_excel'])->name('siswa.export_excel');
    Route::post('/siswa/import_excel', [SiswaIbadahHarianController::class, 'import_excel'])->name('siswa.import_excel');
    
    Route::get('/profilSekolah', [ProfilSekolahController::class, 'index'])->middleware('role:Administrator');
    Route::get('/pengumuman', [PengumumanController::class, 'index']);

    Route::get('/ibadahHarian', [SiswaIbadahHarianController::class, 'index']);
    Route::post('/ibadahHarian', [SiswaIbadahHarianController::class, 'index']);
    Route::get('/ibadahHarian/getKelasIbadahHarian/{kelas_id}', [SiswaIbadahHarianController::class, 'kelas_ibadah_harian']);
    Route::get('/ibadahHarian/export_excel/{sub_kelas_id}', [SiswaIbadahHarianController::class, 'export_excel'])->name('ibadahHarian.export_excel');
    Route::post('/ibadahHarian/export_excel', [SiswaIbadahHarianController::class, 'export_excel'])->name('ibadahHarian.export_excel');
    Route::post('/ibadahHarian/import_excel', [SiswaIbadahHarianController::class, 'import_excel'])->name('ibadahHarian.import_excel');

    Route::get('/tahfidz', [SiswaTahfidzController::class, 'index']);
    Route::post('/tahfidz', [SiswaTahfidzController::class, 'index']);
    Route::get('/tahfidz/getKelasTahfidz/{kelas_id}', [SiswaTahfidzController::class, 'kelas_tahfidz']);
    Route::get('/tahfidz/export_excel/{sub_kelas_id}', [SiswaTahfidzController::class, 'export_excel'])->name('tahfidz.export_excel');
    Route::post('/tahfidz/export_excel', [SiswaTahfidzController::class, 'export_excel'])->name('tahfidz.export_excel');
    Route::post('/tahfidz/import_excel', [SiswaTahfidzController::class, 'import_excel'])->name('tahfidz.import_excel');

    Route::get('/hadist', [SiswaHadistController::class, 'index']);
    Route::post('/hadist', [SiswaHadistController::class, 'index']);
    Route::get('/hadist/getKelasHadist/{kelas_id}', [SiswaHadistController::class, 'kelas_hadist']);
    Route::get('/hadist/export_excel/{sub_kelas_id}', [SiswaHadistController::class, 'export_excel'])->name('hadist.export_excel');
    Route::post('/hadist/export_excel', [SiswaHadistController::class, 'export_excel'])->name('hadist.export_excel');
    Route::post('/hadist/import_excel', [SiswaHadistController::class, 'import_excel'])->name('hadist.import_excel');

    Route::get('/doa', [SiswaDoaController::class, 'index'])->name('doa.index');
    Route::post('/doa', [SiswaDoaController::class, 'index']);
    Route::get('/doa/getKelasDoa/{kelas_id}', [SiswaDoaController::class, 'kelas_doa']);
    Route::get('/doa/export_excel/{sub_kelas_id}', [SiswaDoaController::class, 'export_excel'])->name('doa.export_excel');
    Route::post('/doa/export_excel', [SiswaDoaController::class, 'export_excel'])->name('doa.export_excel');
    Route::post('/doa/import_excel', [SiswaDoaController::class, 'import_excel'])->name('doa.import_excel');
    
    Route::get('/iwr', [SiswaIlmanWaaRuuhanController::class, 'index']);
    Route::post('/iwr', [SiswaIlmanWaaRuuhanController::class, 'index']);
    Route::get('/iwr/export_excel/{sub_kelas_id}', [SiswaIlmanWaaRuuhanController::class, 'export_excel'])->name('iwr.export_excel');
    Route::post('/iwr/export_excel', [SiswaIlmanWaaRuuhanController::class, 'export_excel'])->name('iwr.export_excel');
    Route::post('/iwr/import_excel', [SiswaIlmanWaaRuuhanController::class, 'import_excel'])->name('iwr.import_excel');

    Route::get('/bidangStudi', [SiswaBidangStudiController::class, 'index']);
    Route::post('/bidangStudi', [SiswaBidangStudiController::class, 'index']);
    Route::get('/bidangStudi/export_excel/{sub_kelas_id}', [SiswaBidangStudiController::class, 'export_excel'])->name('bidangStudi.export_excel');
    Route::post('/bidangStudi/export_excel', [SiswaBidangStudiController::class, 'export_excel'])->name('bidangStudi.export_excel');
    Route::post('/bidangStudi/import_excel', [SiswaBidangStudiController::class, 'import_excel'])->name('bidangStudi.import_excel');
    Route::get('/bidangStudi/getKelasMapel/{kelas_id}', [SiswaBidangStudiController::class, 'kelas_mapel']);
    Route::get('/bidangStudi/getSubKelasMapel/{kelas_id}', [SiswaBidangStudiController::class, 'sub_kelas_mapel']);

    Route::get('/raporSiswa', [RaporSiswaController::class, 'index'])->middleware('role:Wali Kelas,Administrator')->name('raporSiswa.index');
    Route::get('/raporSiswa/{id}', [RaporSiswaController::class, 'show'])->middleware('role:Wali Kelas,Administrator')->name('raporSiswa.show');
    Route::post('/raporSiswa', [RaporSiswaController::class, 'index'])->middleware('role:Wali Kelas,Administrator');
    Route::put('/raporSiswa/{id}', [RaporSiswaController::class, 'update'])->middleware('role:Wali Kelas,Administrator')->name('raporSiswa.update');
    //Route::resource('/raporSiswa', RaporSiswaController::class)->middleware('role:Wali Kelas,Administrator');
    Route::get('/raporSiswa/{id}/print', [RaporSiswaController::class, 'print'])->middleware('role:Wali Kelas,Administrator');
    Route::get('/raporSiswa/{id}/detail', [RaporSiswaController::class, 'detail'])->middleware('role:Wali Kelas,Administrator');
    // Route::post('/raporSiswa', [RaporSiswaController::class, 'index']);
    
    Route::resource('/profilSekolah', ProfilSekolahController::class);
    Route::resource('/dataPengumuman', PengumumanController::class);
    
    
    
    Route::resource('/dataBidangStudi', SiswaBidangStudiController::class);
    Route::resource('/dataRaporSiswa', RaporSiswaController::class);
    
    Route::resource('/siswaDoa', SiswaDoaController::class);
    Route::resource('/siswaTahfidz', SiswaTahfidzController::class);
    Route::resource('/siswaHadist', SiswaHadistController::class);
    Route::resource('/siswaIbadahHarian', SiswaIbadahHarianController::class);
    Route::resource('/siswaBidangStudi', SiswaBidangStudiController::class);
    Route::resource('/siswaIlmanWaaRuuhan', SiswaIlmanWaaRuuhanController::class);

    Route::resource('/dataDoa', DoaController::class);
    Route::get('/getTableDataDoa', [DoaController::class, 'getTable'])->name('dataDoa.getTable');
    Route::resource('/dataHadist', HadistController::class);
    Route::get('/getTableDataHadist', [HadistController::class, 'getTable'])->name('dataHadist.getTable');
    Route::resource('/dataTahfidz', TahfidzController::class);
    Route::get('/getTableDataTahfidz', [TahfidzController::class, 'getTable'])->name('dataTahfidz.getTable');
    Route::resource('/dataIbadahHarian', IbadahHarianController::class);
    Route::get('/getTableDataIbadahHarian', [IbadahHarianController::class, 'getTable'])->name('dataIbadahHarian.getTable');
    Route::resource('/dataBidangStudi', BidangStudiController::class);
    Route::get('/getTableDataBidangStudi', [BidangStudiController::class, 'getTable'])->name('dataBidangStudi.getTable');
    Route::resource('/dataIlmanWaaRuuhan', IlmanWaaRuuhanController::class);
    Route::get('/getTableDataIlmanWaaRuuhan', [IlmanWaaRuuhanController::class, 'getTable'])->name('dataIlmanWaaRuuhan.getTable');

    Route::post('/data_doa_update', [DoaController::class, 'update_data_doa'])->name('data_doa.update');
    Route::post('/data_doa_tambah', [DoaController::class, 'store'])->name('data_doa.store');

    Route::post('/data_hadist_update', [HadistController::class, 'update_data_hadist'])->name('data_hadist.update');
    Route::post('/data_hadist_tambah', [HadistController::class, 'store'])->name('data_hadist.store');

    Route::post('/data_tahfidz_update', [TahfidzController::class, 'update_data_tahfidz'])->name('data_tahfidz.update');
    Route::post('/data_tahfidz_tambah', [TahfidzController::class, 'store'])->name('data_tahfidz.store');

    Route::post('/data_ibadah_harian_update', [IbadahHarianController::class, 'update_data_ibadah_harian'])->name('data_ibadah_harian.update');
    Route::post('/data_ibadah_harian_tambah', [IbadahHarianController::class, 'store'])->name('data_ibadah_harian.store');

    Route::post('/data_bidang_studi_update', [BidangStudiController::class, 'update_data_bidang_studi'])->name('data_bidang_studi.update');
    Route::post('/data_bidang_studi_tambah', [BidangStudiController::class, 'store'])->name('data_bidang_studi.store');

    Route::post('/data_iwr_update', [IlmanWaaRuuhanController::class, 'update_data_iwr'])->name('data_iwr.update');
    Route::post('/data_iwr_tambah', [IlmanWaaRuuhanController::class, 'store'])->name('data_iwr.store');

    
    
    Route::get('/tes', function () {
        return view('dashboard');
    });
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/register', function () {
        return view('register');
    });

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
