<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->bigInteger('nilai_akhir')->unsigned()->change();
            $table->foreign('nilai_akhir')->references('id')->on('penilaian_huruf_angkas');
        });
    }

    public function down()
    {
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->dropForeign(['nilai_akhir']);            
        });
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->integer('nilai_akhir')->change();
        });
    }
};
