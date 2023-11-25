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
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            //remove jilid and halaman column
            $table->dropColumn('jilid');
            $table->dropColumn('halaman');
            //add kelas_id
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });

        //add jilid and halaman column to siswa_ilman_waa_ruuhans
        Schema::table('siswa_ilman_waa_ruuhans', function (Blueprint $table) {
            $table->integer('jilid');
            $table->integer('halaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            //add jilid and halaman column
            $table->integer('jilid');
            $table->integer('halaman');
            //remove kelas_id
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
