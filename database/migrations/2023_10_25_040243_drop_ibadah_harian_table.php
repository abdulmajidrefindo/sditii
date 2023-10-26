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
        //unlink the foreign key from siswa_ibadah_harian
        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            $table->dropForeign(['ibadah_harian_2_id']);
            $table->dropForeign(['ibadah_harian_3_id']);
            $table->dropForeign(['ibadah_harian_4_id']);
            $table->dropForeign(['ibadah_harian_5_id']);
            $table->dropForeign(['ibadah_harian_6_id']);
            $table->dropForeign(['ibadah_harian_7_id']);
            $table->dropForeign(['ibadah_harian_8_id']);
            $table->dropForeign(['ibadah_harian_9_id']);
        });

        // drop the column
        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            $table->dropColumn('ibadah_harian_2_id');
            $table->dropColumn('ibadah_harian_3_id');
            $table->dropColumn('ibadah_harian_4_id');
            $table->dropColumn('ibadah_harian_5_id');
            $table->dropColumn('ibadah_harian_6_id');
            $table->dropColumn('ibadah_harian_7_id');
            $table->dropColumn('ibadah_harian_8_id');
            $table->dropColumn('ibadah_harian_9_id');
        });

        // Drop the table
        Schema::dropIfExists('ibadah_harians_2');
        Schema::dropIfExists('ibadah_harians_3');
        Schema::dropIfExists('ibadah_harians_4');
        Schema::dropIfExists('ibadah_harians_5');
        Schema::dropIfExists('ibadah_harians_6');
        Schema::dropIfExists('ibadah_harians_7');
        Schema::dropIfExists('ibadah_harians_8');
        Schema::dropIfExists('ibadah_harians_9');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // Create the table
        Schema::create('ibadah_harians_2', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_4', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_5', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_6', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_7', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_8', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('ibadah_harians_9', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });


        //add the foreign key from siswa_ibadah_harian
        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            $table->foreignId('ibadah_harian_2_id')->nullable()->references('id')->on('ibadah_harians_2');
            $table->foreignId('ibadah_harian_3_id')->nullable()->references('id')->on('ibadah_harians_3');
            $table->foreignId('ibadah_harian_4_id')->nullable()->references('id')->on('ibadah_harians_4');
            $table->foreignId('ibadah_harian_5_id')->nullable()->references('id')->on('ibadah_harians_5');
            $table->foreignId('ibadah_harian_6_id')->nullable()->references('id')->on('ibadah_harians_6');
            $table->foreignId('ibadah_harian_7_id')->nullable()->references('id')->on('ibadah_harians_7');
            $table->foreignId('ibadah_harian_8_id')->nullable()->references('id')->on('ibadah_harians_8');
            $table->foreignId('ibadah_harian_9_id')->nullable()->references('id')->on('ibadah_harians_9');
        });


    }
};
