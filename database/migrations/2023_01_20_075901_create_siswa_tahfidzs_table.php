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
            $table->foreignId('tahfidz_id');
            $table->foreignId('penilaian_deskripsi_id');
            $table->float('nilai_angka');
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
