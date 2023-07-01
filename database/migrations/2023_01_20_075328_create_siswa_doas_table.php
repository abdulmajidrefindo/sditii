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
        Schema::create('siswa_doas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('doa_1_id');
            $table->foreignId('doa_2_id');
            $table->foreignId('doa_3_id');
            $table->foreignId('doa_4_id');
            $table->foreignId('doa_5_id');
            $table->foreignId('doa_6_id');
            $table->foreignId('doa_7_id');
            $table->foreignId('doa_8_id');
            $table->foreignId('doa_9_id');
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
        Schema::dropIfExists('siswa_doas');
    }
};
