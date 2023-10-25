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
        //unlink the foreign key from siswa_tahfidz
        Schema::table('siswa_tahfidzs', function (Blueprint $table) {
            $table->dropForeign(['tahfidz_2_id']);
            $table->dropForeign(['tahfidz_3_id']);
            $table->dropForeign(['tahfidz_4_id']);
            $table->dropForeign(['tahfidz_5_id']);
            $table->dropForeign(['tahfidz_6_id']);
            $table->dropForeign(['tahfidz_7_id']);
            $table->dropForeign(['tahfidz_8_id']);
            $table->dropForeign(['tahfidz_9_id']);
            $table->dropForeign(['tahfidz_10_id']);
            $table->dropForeign(['tahfidz_11_id']);
            $table->dropForeign(['tahfidz_12_id']);
            $table->dropForeign(['tahfidz_13_id']);
            $table->dropForeign(['tahfidz_14_id']);
            $table->dropForeign(['tahfidz_15_id']);
        });

        // drop the column
        Schema::table('siswa_tahfidzs', function (Blueprint $table) {
            $table->dropColumn('tahfidz_2_id');
            $table->dropColumn('tahfidz_3_id');
            $table->dropColumn('tahfidz_4_id');
            $table->dropColumn('tahfidz_5_id');
            $table->dropColumn('tahfidz_6_id');
            $table->dropColumn('tahfidz_7_id');
            $table->dropColumn('tahfidz_8_id');
            $table->dropColumn('tahfidz_9_id');
            $table->dropColumn('tahfidz_10_id');
            $table->dropColumn('tahfidz_11_id');
            $table->dropColumn('tahfidz_12_id');
            $table->dropColumn('tahfidz_13_id');
            $table->dropColumn('tahfidz_14_id');
            $table->dropColumn('tahfidz_15_id');
        });

        // Drop the table
        Schema::dropIfExists('tahfidzs_2');
        Schema::dropIfExists('tahfidzs_3');
        Schema::dropIfExists('tahfidzs_4');
        Schema::dropIfExists('tahfidzs_5');
        Schema::dropIfExists('tahfidzs_6');
        Schema::dropIfExists('tahfidzs_7');
        Schema::dropIfExists('tahfidzs_8');
        Schema::dropIfExists('tahfidzs_9');
        Schema::dropIfExists('tahfidzs_10');
        Schema::dropIfExists('tahfidzs_11');
        Schema::dropIfExists('tahfidzs_12');
        Schema::dropIfExists('tahfidzs_13');
        Schema::dropIfExists('tahfidzs_14');
        Schema::dropIfExists('tahfidzs_15');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //create
        Schema::create('tahfidzs_2', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_4', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_5', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_6', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_7', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_8', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_9', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_10', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_11', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_12', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_13', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_14', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('tahfidzs_15', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        // add the column
        Schema::table('siswa_tahfidzs', function (Blueprint $table) {
            $table->unsignedBigInteger('tahfidz_2_id')->nullable();
            $table->unsignedBigInteger('tahfidz_3_id')->nullable();
            $table->unsignedBigInteger('tahfidz_4_id')->nullable();
            $table->unsignedBigInteger('tahfidz_5_id')->nullable();
            $table->unsignedBigInteger('tahfidz_6_id')->nullable();
            $table->unsignedBigInteger('tahfidz_7_id')->nullable();
            $table->unsignedBigInteger('tahfidz_8_id')->nullable();
            $table->unsignedBigInteger('tahfidz_9_id')->nullable();
            $table->unsignedBigInteger('tahfidz_10_id')->nullable();
            $table->unsignedBigInteger('tahfidz_11_id')->nullable();
            $table->unsignedBigInteger('tahfidz_12_id')->nullable();
            $table->unsignedBigInteger('tahfidz_13_id')->nullable();
            $table->unsignedBigInteger('tahfidz_14_id')->nullable();
            $table->unsignedBigInteger('tahfidz_15_id')->nullable();
        });

        
        // add the foreign key
        Schema::table('siswa_tahfidzs', function (Blueprint $table) {
            $table->foreignId('tahfidz_2_id')->nullable()->references('id')->on('tahfidzs_2');
            $table->foreignId('tahfidz_3_id')->nullable()->references('id')->on('tahfidzs_3');
            $table->foreignId('tahfidz_4_id')->nullable()->references('id')->on('tahfidzs_4');
            $table->foreignId('tahfidz_5_id')->nullable()->references('id')->on('tahfidzs_5');
            $table->foreignId('tahfidz_6_id')->nullable()->references('id')->on('tahfidzs_6');
            $table->foreignId('tahfidz_7_id')->nullable()->references('id')->on('tahfidzs_7');
            $table->foreignId('tahfidz_8_id')->nullable()->references('id')->on('tahfidzs_8');
            $table->foreignId('tahfidz_9_id')->nullable()->references('id')->on('tahfidzs_9');
            $table->foreignId('tahfidz_10_id')->nullable()->references('id')->on('tahfidzs_10');
            $table->foreignId('tahfidz_11_id')->nullable()->references('id')->on('tahfidzs_11');
            $table->foreignId('tahfidz_12_id')->nullable()->references('id')->on('tahfidzs_12');
            $table->foreignId('tahfidz_13_id')->nullable()->references('id')->on('tahfidzs_13');
            $table->foreignId('tahfidz_14_id')->nullable()->references('id')->on('tahfidzs_14');
            $table->foreignId('tahfidz_15_id')->nullable()->references('id')->on('tahfidzs_15');
        });
    }
};
