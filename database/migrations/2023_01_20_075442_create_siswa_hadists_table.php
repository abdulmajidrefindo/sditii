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
        Schema::create('siswa_hadists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('hadist_id');
            $table->foreignId('penilaian_huruf_angka_id');
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
        Schema::dropIfExists('siswa_hadists');
    }
};
