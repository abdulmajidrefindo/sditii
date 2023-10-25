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
        // unlink the foreign key from siswa_bidang_studi
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->dropForeign(['nilai_pas_id']);
        });

        // rename siswa_bidang_studis column, nilai_pas_id to nilai_pas
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->renameColumn('nilai_pas_id', 'nilai_pas');
        });

        // drop nilai_pas
        Schema::dropIfExists('nilai_pass');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create the table
        Schema::create('nilai_pass', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        // rename siswa_bidang_studis column, nilai_pas to nilai_pas_id
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->renameColumn('nilai_pas', 'nilai_pas_id');
        });

        // link the foreign key from siswa_bidang_studi
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->foreignId('nilai_pas_id')->references('id')->on('nilai_pass');
        });
    }
};
