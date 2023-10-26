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
            $table->dropForeign(['nilai_uh_1_id']);
            $table->dropForeign(['nilai_uh_2_id']);
            $table->dropForeign(['nilai_uh_3_id']);
            $table->dropForeign(['nilai_uh_4_id']);
        });

        // rename siswa_bidang_studis column, nilai_uh_1_id to nilai_uh_1
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->renameColumn('nilai_uh_1_id', 'nilai_uh_1');
            $table->renameColumn('nilai_uh_2_id', 'nilai_uh_2');
            $table->renameColumn('nilai_uh_3_id', 'nilai_uh_3');
            $table->renameColumn('nilai_uh_4_id', 'nilai_uh_4');
        });

        // drop nilai_uhs_1 to nilai_uhs_4
        Schema::dropIfExists('nilai_uhs_1');
        Schema::dropIfExists('nilai_uhs_2');
        Schema::dropIfExists('nilai_uhs_3');
        Schema::dropIfExists('nilai_uhs_4');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create the table
        Schema::create('nilai_uhs_1', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai_uhs_2', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai_uhs_3', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('nilai_uhs_4', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        // rename siswa_bidang_studis column, nilai_uh_1 to nilai_uh_1_id
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->dropColumn('nilai_uh_1');
            $table->dropColumn('nilai_uh_2');
            $table->dropColumn('nilai_uh_3');
            $table->dropColumn('nilai_uh_4');
        });

        // link the foreign key from siswa_bidang_studi
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->foreignId('nilai_uh_1_id')->nullable()->references('id')->on('nilai_uhs_1');
            $table->foreignId('nilai_uh_2_id')->nullable()->references('id')->on('nilai_uhs_2');
            $table->foreignId('nilai_uh_3_id')->nullable()->references('id')->on('nilai_uhs_3');
            $table->foreignId('nilai_uh_4_id')->nullable()->references('id')->on('nilai_uhs_4');
        });
    }
};
