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

use App\Http\Controllers\DoaController;
use App\Http\Controllers\HadistController;

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

    Route::resource('/dataUser', UserController::class)->middleware('role:Wali Kelas,Administrator');
    Route::resource('/dataGuru', GuruController::class);
    Route::resource('/dataSiswa', SiswaController::class);
    Route::resource('/dataPeriode', PeriodeController::class);
    
    Route::get('/getTableUser', [UserController::class, 'getTable'])->name('user.getTable');
    Route::get('/getTableGuru', [GuruController::class, 'getTable'])->name('guru.getTable');
    Route::get('/getTableSiswa', [SiswaController::class, 'getTable'])->name('siswa.getTable');
    Route::get('/getTablePeriode', [PeriodeController::class, 'getTable'])->name('periode.getTable');
    
    Route::get('/profilSekolah', [ProfilSekolahController::class, 'index']);
    Route::get('/pengumuman', [PengumumanController::class, 'index']);
    Route::get('/ibadahHarian', [SiswaIbadahHarianController::class, 'index']);
    Route::post('/ibadahHarian', [SiswaIbadahHarianController::class, 'index']);
    Route::get('/tahfidz', [SiswaTahfidzController::class, 'index']);
    Route::post('/tahfidz', [SiswaTahfidzController::class, 'index']);
    Route::get('/hadist', [SiswaHadistController::class, 'index']);
    Route::post('/hadist', [SiswaHadistController::class, 'index']);
    Route::get('/hadist/getKelasHadist/{kelas_id}', [SiswaHadistController::class, 'kelas_hadist']);
    Route::get('/doa', [SiswaDoaController::class, 'index']);
    Route::post('/doa', [SiswaDoaController::class, 'index']);
    Route::get('/doa/getKelasDoa/{kelas_id}', [SiswaDoaController::class, 'kelas_doa']);
    Route::get('/iwr', [SiswaIlmanWaaRuuhanController::class, 'index']);
    Route::post('/iwr', [SiswaIlmanWaaRuuhanController::class, 'index']);
    Route::get('/bidangStudi', [SiswaBidangStudiController::class, 'index']);
    Route::post('/bidangStudi', [SiswaBidangStudiController::class, 'index']);
    Route::get('/bidangStudi/getKelasMapel/{kelas_id}', [SiswaBidangStudiController::class, 'kelas_mapel']);
    Route::get('/raporSiswa', [RaporSiswaController::class, 'index'])->middleware('role:Wali Kelas,Administrator');
    // Route::post('/raporSiswa', [RaporSiswaController::class, 'index']);
    
    Route::resource('/dataProfilSekolah', ProfilSekolahController::class);
    Route::resource('/dataPengumuman', PengumumanController::class);
    
    
    
    Route::resource('/dataBidangStudi', SiswaBidangStudiController::class);
    Route::resource('/dataRaporSiswa', RaporSiswaController::class);
    
    Route::resource('/siswaDoa', SiswaDoaController::class);
    Route::resource('/siswaTahfidz', SiswaTahfidzController::class);
    Route::resource('/siswaHadist', SiswaHadistController::class);
    Route::resource('/siswaIbadahHarian', SiswaIbadahHarianController::class);
    Route::resource('/siswaBidangStudi', SiswaBidangStudiController::class);
    Route::resource('/siswaIlmanWaaRuuhan', SiswaIlmanWaaRuuhanController::class);

    Route::post('/data_doa_update', [DoaController::class, 'update'])->name('data_doa.update');
    Route::post('/data_doa_tambah', [DoaController::class, 'store'])->name('data_doa.store');

    Route::post('/data_hadist_update', [HadistController::class, 'update'])->name('data_hadist.update');
    Route::post('/data_hadist_tambah', [HadistController::class, 'store'])->name('data_hadist.store');
    
    
    Route::get('/tes', function () {
        return view('dashboard');
    });
    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/register', function () {
        return view('register');
    });
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');    

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
