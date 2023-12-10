<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

//Dashboard > /raporSiswa
Breadcrumbs::for('raporSiswa', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Rapor Siswa', route('raporSiswa.index'));
});

//Dashboard > /raporSiswa > [raporSiswa]
Breadcrumbs::for('raporSiswa.show', function (BreadcrumbTrail $trail, $raporSiswa) {
    $trail->parent('raporSiswa');
    $trail->push($raporSiswa->nama_siswa, route('raporSiswa.show', $raporSiswa->id));
});

//Dashboard > /dataUser
Breadcrumbs::for('dataUser', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data User', route('dataUser.index'));
});

//Dashboard > /dataUser > [user]
Breadcrumbs::for('dataUser.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('dataUser');
    $trail->push($user->name, route('dataUser.show', $user->id));
});

//Dashboard > /profilSekolah
Breadcrumbs::for('profilSekolah', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profil Sekolah', route('profilSekolah.index'));
});

//Dashboard > /dataPeriode
Breadcrumbs::for('dataPeriode', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Periode', route('dataPeriode.index'));
});

//Dashboard > /dataPeriode > [periode]
Breadcrumbs::for('dataPeriode.show', function (BreadcrumbTrail $trail, $periode) {
    $trail->parent('dataPeriode');
    $genap_ganjil = $periode->semester == 1 ? 'Ganjil' : 'Genap';
    $periode->nama_periode = $genap_ganjil . ' ' . $periode->tahun_ajaran;
    $trail->push($periode->nama_periode, route('dataPeriode.show', $periode->id));
});

//Dashboard > /dataGuru
Breadcrumbs::for('dataGuru', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Guru', route('dataGuru.index'));
});

//Dashboard > /dataGuru > [guru]
Breadcrumbs::for('dataGuru.show', function (BreadcrumbTrail $trail, $guru) {
    $trail->parent('dataGuru');
    $trail->push($guru->nama_guru, route('dataGuru.show', $guru->id));
});

//Dashboard > /dataKelas
Breadcrumbs::for('dataKelas', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Kelas', route('dataKelas.index'));
});

//Dashboard > /dataKelas > [kelas]
Breadcrumbs::for('dataKelas.show', function (BreadcrumbTrail $trail, $kelas) {
    $trail->parent('dataKelas');
    $nama_kelas = $kelas->kelas->nama_kelas . ' ' . $kelas->nama_sub_kelas;
    $trail->push($nama_kelas, route('dataKelas.show', $kelas->id));
});

//Dashboard > /dataSiswa
Breadcrumbs::for('dataSiswa', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Siswa', route('dataSiswa.index'));
});

//Dashboard > /dataSiswa > [siswa]
Breadcrumbs::for('dataSiswa.show', function (BreadcrumbTrail $trail, $siswa) {
    $trail->parent('dataSiswa');
    $trail->push($siswa->nama_siswa, route('dataSiswa.show', $siswa->id));
});

//Dashboard > /dataIlmanWaaRuuhan
Breadcrumbs::for('dataIlmanWaaRuuhan', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Ilman Waa Ruuhan', route('dataIlmanWaaRuuhan.index'));
});

//Dashboard > /dataIlmanWaaRuuhan > [ilmanWaaRuuhan]
Breadcrumbs::for('dataIlmanWaaRuuhan.show', function (BreadcrumbTrail $trail, $ilmanWaaRuuhan) {
    $trail->parent('dataIlmanWaaRuuhan');
    $trail->push($ilmanWaaRuuhan->pencapaian, route('dataIlmanWaaRuuhan.show', $ilmanWaaRuuhan->id));
});

//Dashboard > /dataBidangStudi
Breadcrumbs::for('dataBidangStudi', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Bidang Studi', route('dataBidangStudi.index'));
});

//Dashboard > /dataBidangStudi > [bidangStudi]
Breadcrumbs::for('dataBidangStudi.show', function (BreadcrumbTrail $trail, $bidangStudi) {
    $trail->parent('dataBidangStudi');
    $trail->push($bidangStudi->nama_mapel, route('dataBidangStudi.show', $bidangStudi->id));
});

//Dashboard > /dataIbadahHarian
Breadcrumbs::for('dataIbadahHarian', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Ibadah Harian', route('dataIbadahHarian.index'));
});

//Dashboard > /dataIbadahHarian > [ibadahHarian]
Breadcrumbs::for('dataIbadahHarian.show', function (BreadcrumbTrail $trail, $ibadahHarian) {
    $trail->parent('dataIbadahHarian');
    $trail->push($ibadahHarian->nama_kriteria, route('dataIbadahHarian.show', $ibadahHarian->id));
});

//Dashboard > /dataTahfidz
Breadcrumbs::for('dataTahfidz', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Tahfidz', route('dataTahfidz.index'));
});

//Dashboard > /dataTahfidz > [tahfidz]
Breadcrumbs::for('dataTahfidz.show', function (BreadcrumbTrail $trail, $tahfidz) {
    $trail->parent('dataTahfidz');
    $trail->push($tahfidz->nama_nilai, route('dataTahfidz.show', $tahfidz->id));
});

//Dashboard > /dataHadist
Breadcrumbs::for('dataHadist', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Hadist', route('dataHadist.index'));
});

//Dashboard > /dataHadist > [hadist]
Breadcrumbs::for('dataHadist.show', function (BreadcrumbTrail $trail, $hadist) {
    $trail->parent('dataHadist');
    $trail->push($hadist->nama_nilai, route('dataHadist.show', $hadist->id));
});

//Dashboard > /dataDoa
Breadcrumbs::for('dataDoa', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Data Doa', route('dataDoa.index'));
});

//Dashboard > /dataDoa > [doa]
Breadcrumbs::for('dataDoa.show', function (BreadcrumbTrail $trail, $doa) {
    $trail->parent('dataDoa');
    $trail->push($doa->nama_nilai, route('dataDoa.show', $doa->id));
});

//Dashboard > dataIlmanWaaRuuhan > /siswaIlmanWaaRuuhan
Breadcrumbs::for('siswaIlmanWaaRuuhan', function (BreadcrumbTrail $trail) {
    $trail->parent('dataIlmanWaaRuuhan');
    $trail->push('Nilai Ilman Waa Ruuhan', route('siswaIlmanWaaRuuhan.index'));
});

//Dashboard > /siswaIlmanWaaRuuhan > [siswaIlmanWaaRuuhan]
Breadcrumbs::for('siswaIlmanWaaRuuhan.show', function (BreadcrumbTrail $trail, $siswaIlmanWaaRuuhan) {
    $trail->parent('siswaIlmanWaaRuuhan');
    $trail->push($siswaIlmanWaaRuuhan->siswa->nama_siswa, route('siswaIlmanWaaRuuhan.show', $siswaIlmanWaaRuuhan->siswa->id));
});

//Dashboard > dataBidangStudi > /siswaBidangStudi
Breadcrumbs::for('siswaBidangStudi', function (BreadcrumbTrail $trail) {
    $trail->parent('dataBidangStudi');
    $trail->push('Nilai Bidang Studi', route('siswaBidangStudi.index'));
});

//Dashboard > /siswaBidangStudi > [siswaBidangStudi]
Breadcrumbs::for('siswaBidangStudi.show', function (BreadcrumbTrail $trail, $siswaBidangStudi) {
    $trail->parent('siswaBidangStudi');
    $trail->push($siswaBidangStudi->siswa->nama_siswa, route('siswaBidangStudi.show', $siswaBidangStudi->siswa->id));
});

//Dashboard > dataIbadahHarian > /siswaIbadahHarian
Breadcrumbs::for('siswaIbadahHarian', function (BreadcrumbTrail $trail) {
    $trail->parent('dataIbadahHarian');
    $trail->push('Nilai Ibadah Harian', route('siswaIbadahHarian.index'));
});

//Dashboard > /siswaIbadahHarian > [siswaIbadahHarian]
Breadcrumbs::for('siswaIbadahHarian.show', function (BreadcrumbTrail $trail, $siswaIbadahHarian) {
    $trail->parent('siswaIbadahHarian');
    $trail->push($siswaIbadahHarian->siswa->nama_siswa, route('siswaIbadahHarian.show', $siswaIbadahHarian->siswa->id));
});

//Dashboard > dataTahfidz > /siswaTahfidz
Breadcrumbs::for('siswaTahfidz', function (BreadcrumbTrail $trail) {
    $trail->parent('dataTahfidz');
    $trail->push('Nilai Tahfidz', route('siswaTahfidz.index'));
});

//Dashboard > /siswaTahfidz > [siswaTahfidz]
Breadcrumbs::for('siswaTahfidz.show', function (BreadcrumbTrail $trail, $siswaTahfidz) {
    $trail->parent('siswaTahfidz');
    $trail->push($siswaTahfidz->siswa->nama_siswa, route('siswaTahfidz.show', $siswaTahfidz->siswa->id));
});

//Dashboard > dataHadist > /siswaHadist
Breadcrumbs::for('siswaHadist', function (BreadcrumbTrail $trail) {
    $trail->parent('dataHadist');
    $trail->push('Nilai Hadist', route('siswaHadist.index'));
});

//Dashboard > /siswaHadist > [siswaHadist]
Breadcrumbs::for('siswaHadist.show', function (BreadcrumbTrail $trail, $siswaHadist) {
    $trail->parent('siswaHadist');
    $trail->push($siswaHadist->siswa->nama_siswa, route('siswaHadist.show', $siswaHadist->siswa->id));
});

//Dashboard > dataDoa > /siswaDoa
Breadcrumbs::for('siswaDoa', function (BreadcrumbTrail $trail) {
    $trail->parent('dataDoa');
    $trail->push('Nilai Doa', route('siswaDoa.index'));
});

//Dashboard > /siswaDoa > [siswaDoa]
Breadcrumbs::for('siswaDoa.show', function (BreadcrumbTrail $trail, $siswaDoa) {
    $trail->parent('siswaDoa');
    $trail->push($siswaDoa->siswa->nama_siswa, route('siswaDoa.show', $siswaDoa->siswa->id));
});
