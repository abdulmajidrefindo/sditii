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
        Schema::create('siswa_tahfidzs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('tahfidz_1_id');
            $table->foreignId('tahfidz_2_id');
            $table->foreignId('tahfidz_3_id');
            $table->foreignId('tahfidz_4_id');
            $table->foreignId('tahfidz_5_id');
            $table->foreignId('tahfidz_6_id');
            $table->foreignId('tahfidz_7_id');
            $table->foreignId('tahfidz_8_id');
            $table->foreignId('tahfidz_9_id');
            $table->foreignId('tahfidz_10_id');
            $table->foreignId('tahfidz_11_id');
            $table->foreignId('tahfidz_12_id');
            $table->foreignId('tahfidz_13_id');
            $table->foreignId('tahfidz_14_id');
            $table->foreignId('tahfidz_15_id');
            // $table->float('nilai_angka');
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
        Schema::dropIfExists('siswa_tahfidzs');
    }
};
