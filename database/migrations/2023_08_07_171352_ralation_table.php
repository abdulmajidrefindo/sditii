<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            //siswas
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
            $table->foreignId('kelas_id')->nullable()->references('id')->on('kelas');
        });
        Schema::table('gurus', function (Blueprint $table) {
            //gurus
            $table->foreignId('user_id')->nullable()->references('id')->on('user');
        });
        Schema::table('kelas', function (Blueprint $table) {
            //kelas
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('format_rapors', function (Blueprint $table) {
            //format_rapors
            $table->foreignId('kelas_id')->nullable()->references('id')->on('kelas');
        });
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            //ilman_waa_ruuhans
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('pengumumen', function (Blueprint $table) {
            //pengumumen
            $table->foreignId('user_id')->nullable()->references('id')->on('user');
        });
        Schema::table('siswa_doas', function (Blueprint $table) {
            //siswa_doas
            $table->foreignId('siswa_id')->nullable()->references('id')->on('siswas');
            $table->foreignId('doa_1_id')->nullable()->references('id')->on('doas_1');
            $table->foreignId('doa_2_id')->nullable()->references('id')->on('doas_2');
            $table->foreignId('doa_3_id')->nullable()->references('id')->on('doas_3');
            $table->foreignId('doa_4_id')->nullable()->references('id')->on('doas_4');
            $table->foreignId('doa_5_id')->nullable()->references('id')->on('doas_5');
            $table->foreignId('doa_6_id')->nullable()->references('id')->on('doas_6');
            $table->foreignId('doa_7_id')->nullable()->references('id')->on('doas_7');
            $table->foreignId('doa_8_id')->nullable()->references('id')->on('doas_8');
            $table->foreignId('doa_9_id')->nullable()->references('id')->on('doas_9');
            $table->foreignId('profil_sekolah_id')->nullable()->references('id')->on('profil_sekolahs');
            $table->foreignId('periode_id')->nullable()->references('id')->on('periodes');
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
        });
        Schema::table('siswa_hadists', function (Blueprint $table) {
            //siswa_hadists
            $table->foreignId('siswa_id')->nullable()->references('id')->on('siswas');
            $table->foreignId('hadist_1_id')->nullable()->references('id')->on('hadists_1');
            $table->foreignId('hadist_2_id')->nullable()->references('id')->on('hadists_2');
            $table->foreignId('hadist_3_id')->nullable()->references('id')->on('hadists_3');
            $table->foreignId('hadist_4_id')->nullable()->references('id')->on('hadists_4');
            $table->foreignId('hadist_5_id')->nullable()->references('id')->on('hadists_5');
            $table->foreignId('hadist_6_id')->nullable()->references('id')->on('hadists_6');
            $table->foreignId('hadist_7_id')->nullable()->references('id')->on('hadists_7');
            $table->foreignId('hadist_8_id')->nullable()->references('id')->on('hadists_8');
            $table->foreignId('hadist_9_id')->nullable()->references('id')->on('hadists_9');
            $table->foreignId('profil_sekolah_id')->nullable()->references('id')->on('profil_sekolahs');
            $table->foreignId('periode_id')->nullable()->references('id')->on('periodes');
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
        });
        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            //siswa_ibadah_harians
            $table->foreignId('siswa_id')->nullable()->references('id')->on('siswas');
            $table->foreignId('ibadah_harian_1_id')->nullable()->references('id')->on('ibadah_harians_1');
            $table->foreignId('ibadah_harian_2_id')->nullable()->references('id')->on('ibadah_harians_2');
            $table->foreignId('ibadah_harian_3_id')->nullable()->references('id')->on('ibadah_harians_3');
            $table->foreignId('ibadah_harian_4_id')->nullable()->references('id')->on('ibadah_harians_4');
            $table->foreignId('ibadah_harian_5_id')->nullable()->references('id')->on('ibadah_harians_5');
            $table->foreignId('ibadah_harian_6_id')->nullable()->references('id')->on('ibadah_harians_6');
            $table->foreignId('ibadah_harian_7_id')->nullable()->references('id')->on('ibadah_harians_7');
            $table->foreignId('ibadah_harian_8_id')->nullable()->references('id')->on('ibadah_harians_8');
            $table->foreignId('ibadah_harian_9_id')->nullable()->references('id')->on('ibadah_harians_9');
            $table->foreignId('profil_sekolah_id')->nullable()->references('id')->on('profil_sekolahs');
            $table->foreignId('periode_id')->nullable()->references('id')->on('periodes');
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
        });
        Schema::table('siswa_ilman_waa_ruuhans', function (Blueprint $table) {
            //siswa_ilman_waa_ruuhans
            $table->foreignId('siswa_id')->nullable()->references('id')->on('siswas');
            $table->foreignId('ilman_waa_ruuhan_id')->nullable()->references('id')->on('ilman_waa_ruuhans');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
            $table->foreignId('profil_sekolah_id')->nullable()->references('id')->on('profil_sekolahs');
            $table->foreignId('periode_id')->nullable()->references('id')->on('periodes');
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
        });
        Schema::table('siswa_tahfidzs', function (Blueprint $table) {
            //siswa_tahfidz
            $table->foreignId('siswa_id')->nullable()->references('id')->on('siswas');
            $table->foreignId('tahfidz_1_id')->nullable()->references('id')->on('tahfidzs_1');
            $table->foreignId('tahfidz_2_id')->nullable()->references('id')->on('tahfidzs_2');
            $table->foreignId('tahfidz_3_id')->nullable()->references('id')->on('tahfidzs_3');
            $table->foreignId('tahfidz_4_id')->nullable()->references('id')->on('tahfidzs_4');
            $table->foreignId('tahfidz_5_id')->nullable()->references('id')->on('tahfidzs_5');
            $table->foreignId('tahfidz_6_id')->nullable()->references('id')->on('tahfidzs_6');
            $table->foreignId('tahfidz_7_id')->nullable()->references('id')->on('tahfidzs_7');
            $table->foreignId('tahfidz_8_id')->nullable()->references('id')->on('tahfidzs_8');
            $table->foreignId('tahfidz_9_id')->nullable()->references('id')->on('tahfidzs_9');
            $table->foreignId('tahfidz_10_id')->nullable()->references('id')->on('tahfidzs_10');
            $table->foreignId('tahfidz_11_id')->nullable()->references('id')->on('tahfidzs_11');
            $table->foreignId('tahfidz_12_id')->nullable()->references('id')->on('tahfidzs_12');
            $table->foreignId('tahfidz_13_id')->nullable()->references('id')->on('tahfidzs_13');
            $table->foreignId('tahfidz_14_id')->nullable()->references('id')->on('tahfidzs_14');
            $table->foreignId('tahfidz_15_id')->nullable()->references('id')->on('tahfidzs_15');
            $table->foreignId('profil_sekolah_id')->nullable()->references('id')->on('profil_sekolahs');
            $table->foreignId('periode_id')->nullable()->references('id')->on('periodes');
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
        });
        Schema::table('user_roles', function (Blueprint $table) {
            //user_roles
            $table->foreignId('user_id')->nullable()->references('id')->on('user');
            $table->foreignId('role_id')->nullable()->references('id')->on('roles');
        });
        Schema::table('nilai_pass', function (Blueprint $table) {
            //nilai_pass
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('nilai_utss', function (Blueprint $table) {
            //nilai_utss
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('mapels', function (Blueprint $table) {
            //mapels
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            //siswa_bidang_studis
            $table->foreignId('siswa_id')->nullable()->references('id')->on('siswas');
            $table->foreignId('mapel_id')->nullable()->references('id')->on('mapels');
            $table->foreignId('nilai_uh_1_id')->nullable()->references('id')->on('nilai_uhs_1');
            $table->foreignId('nilai_uh_2_id')->nullable()->references('id')->on('nilai_uhs_2');
            $table->foreignId('nilai_uh_3_id')->nullable()->references('id')->on('nilai_uhs_3');
            $table->foreignId('nilai_uh_4_id')->nullable()->references('id')->on('nilai_uhs_4');
            $table->foreignId('nilai_tugas_1_id')->nullable()->references('id')->on('nilai_tugass_1');
            $table->foreignId('nilai_tugas_2_id')->nullable()->references('id')->on('nilai_tugass_2');
            $table->foreignId('nilai_uts_id')->nullable()->references('id')->on('nilai_utss');
            $table->foreignId('nilai_pas_id')->nullable()->references('id')->on('nilai_pass');
            $table->foreignId('profil_sekolah_id')->nullable()->references('id')->on('profil_sekolahs');
            $table->foreignId('periode_id')->nullable()->references('id')->on('periodes');
            $table->foreignId('rapor_siswa_id')->nullable()->references('id')->on('rapor_siswas');
        });
        Schema::table('nilai_tugass_1', function (Blueprint $table) {
            //nilai_tugass_1
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('nilai_tugass_2', function (Blueprint $table) {
            //nilai_tugass_2
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('nilai_uhs_1', function (Blueprint $table) {
            //nilai_uhs_1
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('nilai_uhs_2', function (Blueprint $table) {
            //nilai_uhs_2
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('nilai_uhs_3', function (Blueprint $table) {
            //nilai_uhs_3
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('nilai_uhs_4', function (Blueprint $table) {
            //nilai_uhs_4
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
        Schema::table('doas_1', function (Blueprint $table) {
            //doa_1
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_2', function (Blueprint $table) {
            //doa_2
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_3', function (Blueprint $table) {
            //doa_3
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_4', function (Blueprint $table) {
            //doa_4
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_5', function (Blueprint $table) {
            //doa_5
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_6', function (Blueprint $table) {
            //doa_6
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_7', function (Blueprint $table) {
            //doa_7
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_8', function (Blueprint $table) {
            //doa_8
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('doas_9', function (Blueprint $table) {
            //doa_9
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_1', function (Blueprint $table) {
            //hadist_1
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_2', function (Blueprint $table) {
            //hadist_2
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_3', function (Blueprint $table) {
            //hadist_3
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_4', function (Blueprint $table) {
            //hadist_4
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_5', function (Blueprint $table) {
            //hadist_5
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_6', function (Blueprint $table) {
            //hadist_6
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_7', function (Blueprint $table) {
            //hadist_7
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_8', function (Blueprint $table) {
            //hadist_8
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('hadists_9', function (Blueprint $table) {
            //hadist_9
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('ibadah_harians_1', function (Blueprint $table) {
            //ibadah_harians_1
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_2', function (Blueprint $table) {
            //ibadah_harians_2
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_3', function (Blueprint $table) {
            //ibadah_harians_3
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_4', function (Blueprint $table) {
            //ibadah_harians_4
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_5', function (Blueprint $table) {
            //ibadah_harians_5
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_6', function (Blueprint $table) {
            //ibadah_harians_6
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_7', function (Blueprint $table) {
            //ibadah_harians_7
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_8', function (Blueprint $table) {
            //ibadah_harians_8
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('ibadah_harians_9', function (Blueprint $table) {
            //ibadah_harians_9
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
        Schema::table('tahfidzs_1', function (Blueprint $table) {
            //tahfidzs_1
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_2', function (Blueprint $table) {
            //tahfidzs_2
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_3', function (Blueprint $table) {
            //tahfidzs_3
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_4', function (Blueprint $table) {
            //tahfidzs_4
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_5', function (Blueprint $table) {
            //tahfidzs_5
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_6', function (Blueprint $table) {
            //tahfidzs_6
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_7', function (Blueprint $table) {
            //tahfidzs_7
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_8', function (Blueprint $table) {
            //tahfidzs_8
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_9', function (Blueprint $table) {
            //tahfidzs_9
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_10', function (Blueprint $table) {
            //tahfidzs_10
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_11', function (Blueprint $table) {
            //tahfidzs_11
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_12', function (Blueprint $table) {
            //tahfidzs_12
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_13', function (Blueprint $table) {
            //tahfidzs_13
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_14', function (Blueprint $table) {
            //tahfidzs_14
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
        Schema::table('tahfidzs_15', function (Blueprint $table) {
            //tahfidzs_15
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->foreignId('guru_id')->nullable()->references('id')->on('gurus');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['rapor_siswa_id']);
            $table->dropForeign(['kelas_id']);
        });
    
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
        });
    
        Schema::table('format_rapors', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
        });
    
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
        });
    
        Schema::table('pengumumen', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('siswa_doas', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['doa_1_id']);
            $table->dropForeign(['doa_2_id']);
            $table->dropForeign(['doa_3_id']);
            $table->dropForeign(['doa_4_id']);
            $table->dropForeign(['doa_5_id']);
            $table->dropForeign(['doa_6_id']);
            $table->dropForeign(['doa_7_id']);
            $table->dropForeign(['doa_8_id']);
            $table->dropForeign(['doa_9_id']);
            $table->dropForeign(['profil_sekolah_id']);
            $table->dropForeign(['periode_id']);
            $table->dropForeign(['rapor_siswa_id']);
        });

        Schema::table('siswa_hadists', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['hadist_1_id']);
            $table->dropForeign(['hadist_2_id']);
            $table->dropForeign(['hadist_3_id']);
            $table->dropForeign(['hadist_4_id']);
            $table->dropForeign(['hadist_5_id']);
            $table->dropForeign(['hadist_6_id']);
            $table->dropForeign(['hadist_7_id']);
            $table->dropForeign(['hadist_8_id']);
            $table->dropForeign(['hadist_9_id']);
            $table->dropForeign(['profil_sekolah_id']);
            $table->dropForeign(['periode_id']);
            $table->dropForeign(['rapor_siswa_id']);
        });

        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['ibadah_harian_1_id']);
            $table->dropForeign(['ibadah_harian_2_id']);
            $table->dropForeign(['ibadah_harian_3_id']);
            $table->dropForeign(['ibadah_harian_4_id']);
            $table->dropForeign(['ibadah_harian_5_id']);
            $table->dropForeign(['ibadah_harian_6_id']);
            $table->dropForeign(['ibadah_harian_7_id']);
            $table->dropForeign(['ibadah_harian_8_id']);
            $table->dropForeign(['ibadah_harian_9_id']);
            $table->dropForeign(['profil_sekolah_id']);
            $table->dropForeign(['periode_id']);
            $table->dropForeign(['rapor_siswa_id']);
        });

        Schema::table('siswa_tahfidzs', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['tahfidz_1_id']);
            $table->dropForeign(['tahfidz_2_id']);
            $table->dropForeign(['tahfidz_3_id']);
            $table->dropForeign(['tahfidz_4_id']);
            $table->dropForeign(['tahfidz_5_id']);
            $table->dropForeign(['tahfidz_6_id']);
            $table->dropForeign(['tahfidz_7_id']);
            $table->dropForeign(['tahfidz_8_id']);
            $table->dropForeign(['tahfidz_9_id']);
            $table->dropForeign(['tahfidz_10_id']);
            $table->dropForeign(['tahfidz_11_id']);
            $table->dropForeign(['tahfidz_12_id']);
            $table->dropForeign(['tahfidz_13_id']);
            $table->dropForeign(['tahfidz_14_id']);
            $table->dropForeign(['tahfidz_15_id']);
            $table->dropForeign(['profil_sekolah_id']);
            $table->dropForeign(['periode_id']);
            $table->dropForeign(['rapor_siswa_id']);
        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });

        

       

        Schema::table('mapels', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
        });

        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['mapel_id']);
            $table->dropForeign(['nilai_uh_1_id']);
            $table->dropForeign(['nilai_uh_2_id']);
            $table->dropForeign(['nilai_uh_3_id']);
            $table->dropForeign(['nilai_uh_4_id']);
            $table->dropForeign(['nilai_tugas_1_id']);
            $table->dropForeign(['nilai_tugas_2_id']);
            $table->dropForeign(['nilai_uts_id']);
            $table->dropForeign(['nilai_pas_id']);
            $table->dropForeign(['profil_sekolah_id']);
            $table->dropForeign(['periode_id']);
            $table->dropForeign(['rapor_siswa_id']);
        });

        

        Schema::table('doas_1', function (Blueprint $table) {
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropForeign(['guru_id']);
        });

        

        Schema::table('hadists_1', function (Blueprint $table) {
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropForeign(['guru_id']);
        });
    
        

        Schema::table('ibadah_harians_1', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['penilaian_deskripsi_id']);
        });
    
        

        Schema::table('tahfidzs_1', function (Blueprint $table) {
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropForeign(['guru_id']);
        });
    
        
        
    }
};
