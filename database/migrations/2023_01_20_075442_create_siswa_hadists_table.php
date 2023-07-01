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
            $table->foreignId('hadist_1_id');
            $table->foreignId('hadist_2_id');
            $table->foreignId('hadist_3_id');
            $table->foreignId('hadist_4_id');
            $table->foreignId('hadist_5_id');
            $table->foreignId('hadist_6_id');
            $table->foreignId('hadist_7_id');
            $table->foreignId('hadist_8_id');
            $table->foreignId('hadist_9_id');
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
