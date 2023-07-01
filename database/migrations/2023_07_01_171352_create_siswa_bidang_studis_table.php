<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_bidang_studis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('mapel_id');
            $table->foreignId('nilai_uh_1_id');
            $table->foreignId('nilai_uh_2_id');
            $table->foreignId('nilai_uh_3_id');
            $table->foreignId('nilai_uh_4_id');
            $table->foreignId('nilai_tugas_1_id');
            $table->foreignId('nilai_tugas_2_id');
            $table->foreignId('nilai_uts_id');
            $table->foreignId('nilai_pas_id');
            $table->integer('nilai_akhir')->nullable();
            $table->foreignId('profil_sekolah_id');
            $table->foreignId('periode_id');
            $table->foreignId('rapor_siswa_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_bidang_studis');
    }
};
