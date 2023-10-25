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
        // unlink the foreign key
        Schema::table('siswa_doas', function (Blueprint $table) {
            $table->dropForeign(['doa_2_id']);
            $table->dropForeign(['doa_3_id']);
            $table->dropForeign(['doa_4_id']);
            $table->dropForeign(['doa_5_id']);
            $table->dropForeign(['doa_6_id']);
            $table->dropForeign(['doa_7_id']);
            $table->dropForeign(['doa_8_id']);
            $table->dropForeign(['doa_9_id']);
        });

        // drop the column
        Schema::table('siswa_doas', function (Blueprint $table) {
            $table->dropColumn('doa_2_id');
            $table->dropColumn('doa_3_id');
            $table->dropColumn('doa_4_id');
            $table->dropColumn('doa_5_id');
            $table->dropColumn('doa_6_id');
            $table->dropColumn('doa_7_id');
            $table->dropColumn('doa_8_id');
            $table->dropColumn('doa_9_id');
        });

        // Drop the table
        Schema::dropIfExists('doas_2');
        Schema::dropIfExists('doas_3');
        Schema::dropIfExists('doas_4');
        Schema::dropIfExists('doas_5');
        Schema::dropIfExists('doas_6');
        Schema::dropIfExists('doas_7');
        Schema::dropIfExists('doas_8');
        Schema::dropIfExists('doas_9');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // create the table
        Schema::create('doas_2', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_4', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_5', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_6', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_7', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_8', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('doas_9', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        // add the column
        Schema::table('siswa_doas', function (Blueprint $table) {
            $table->unsignedBigInteger('doa_2_id')->nullable();
            $table->unsignedBigInteger('doa_3_id')->nullable();
            $table->unsignedBigInteger('doa_4_id')->nullable();
            $table->unsignedBigInteger('doa_5_id')->nullable();
            $table->unsignedBigInteger('doa_6_id')->nullable();
            $table->unsignedBigInteger('doa_7_id')->nullable();
            $table->unsignedBigInteger('doa_8_id')->nullable();
            $table->unsignedBigInteger('doa_9_id')->nullable();
        });

                // add the foreign key
        Schema::table('siswa_doas', function (Blueprint $table) {
            $table->foreignId('doa_2_id')->nullable()->references('id')->on('doas_2');
            $table->foreignId('doa_3_id')->nullable()->references('id')->on('doas_3');
            $table->foreignId('doa_4_id')->nullable()->references('id')->on('doas_4');
            $table->foreignId('doa_5_id')->nullable()->references('id')->on('doas_5');
            $table->foreignId('doa_6_id')->nullable()->references('id')->on('doas_6');
            $table->foreignId('doa_7_id')->nullable()->references('id')->on('doas_7');
            $table->foreignId('doa_8_id')->nullable()->references('id')->on('doas_8');
            $table->foreignId('doa_9_id')->nullable()->references('id')->on('doas_9');
        });
    }

};
