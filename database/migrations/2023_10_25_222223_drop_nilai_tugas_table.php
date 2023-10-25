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
            $table->dropForeign(['nilai_tugas_1_id']);
            $table->dropForeign(['nilai_tugas_2_id']);
        });

        // rename siswa_bidang_studis column, nilai_tugas_1_id to nilai_tugas_1
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->renameColumn('nilai_tugas_1_id', 'nilai_tugas_1');
            $table->renameColumn('nilai_tugas_2_id', 'nilai_tugas_2');
        });

        // drop nilai_tugas_1 to nilai_tugas_2
        Schema::dropIfExists('nilai_tugass_1');
        Schema::dropIfExists('nilai_tugass_2');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create the table
        Schema::create('nilai_tugass_1', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai_tugass_2', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        // rename siswa_bidang_studis column, nilai_tugas_1 to nilai_tugas_1_id
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->renameColumn('nilai_tugas_1', 'nilai_tugas_1_id');
            $table->renameColumn('nilai_tugas_2', 'nilai_tugas_2_id');
        });

        // link the foreign key from siswa_bidang_studi
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->foreignId('nilai_tugas_1_id')->nullable()->references('id')->on('nilai_tugass_1');
            $table->foreignId('nilai_tugas_2_id')->nullable()->references('id')->on('nilai_tugass_2');
        });
    }
};
