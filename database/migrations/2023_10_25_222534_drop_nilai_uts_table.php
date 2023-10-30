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
            $table->dropForeign(['nilai_uts_id']);
        });

        // rename siswa_bidang_studis column, nilai_uts_id to nilai_uts
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->renameColumn('nilai_uts_id', 'nilai_uts');
        });

        // drop nilai_uts
        Schema::dropIfExists('nilai_utss');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create the table
        Schema::create('nilai_utss', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        // rename siswa_bidang_studis column, nilai_uts to nilai_uts_id
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->dropColumn('nilai_uts');
        });

        // link the foreign key from siswa_bidang_studi
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->foreignId('nilai_uts_id')->nullable()->references('id')->on('nilai_utss');
        });
    }
};
