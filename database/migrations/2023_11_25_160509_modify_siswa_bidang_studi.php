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
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->bigInteger('nilai_akhir')->unsigned()->change();
            $table->foreign('nilai_akhir')->references('id')->on('penilaian_huruf_angkas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // unlink the foreign key from siswa_bidang_studi
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            
            $table->dropForeign(['nilai_akhir']);
            
        });

        // change the column type back to integer
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->integer('nilai_akhir')->change();
        });
    }
};
