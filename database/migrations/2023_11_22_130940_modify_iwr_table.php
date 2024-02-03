<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            $table->dropColumn('jilid');
            $table->dropColumn('halaman');
            //add kelas_id
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });

        Schema::table('siswa_ilman_waa_ruuhans', function (Blueprint $table) {
            $table->integer('jilid');
            $table->integer('halaman');
        });
    }

    public function down()
    {
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            $table->integer('jilid');
            $table->integer('halaman');
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
