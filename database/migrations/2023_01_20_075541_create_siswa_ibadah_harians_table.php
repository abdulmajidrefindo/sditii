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
        Schema::create('siswa_ibadah_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('ibadah_harian_1_id');
            $table->foreignId('ibadah_harian_2_id');
            $table->foreignId('ibadah_harian_3_id');
            $table->foreignId('ibadah_harian_4_id');
            $table->foreignId('ibadah_harian_5_id');
            $table->foreignId('ibadah_harian_6_id');
            $table->foreignId('ibadah_harian_7_id');
            $table->foreignId('ibadah_harian_8_id');
            $table->foreignId('ibadah_harian_9_id');
            // $table->foreignId('penilaian_deskripsi_id');
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
        Schema::dropIfExists('siswa_ibadah_harians');
    }
};
