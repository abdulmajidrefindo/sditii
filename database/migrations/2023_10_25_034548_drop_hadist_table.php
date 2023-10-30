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
        //unlink the foreign key from siswa_hadist
        Schema::table('siswa_hadists', function (Blueprint $table) {
            $table->dropForeign(['hadist_2_id']);
            $table->dropForeign(['hadist_3_id']);
            $table->dropForeign(['hadist_4_id']);
            $table->dropForeign(['hadist_5_id']);
            $table->dropForeign(['hadist_6_id']);
            $table->dropForeign(['hadist_7_id']);
            $table->dropForeign(['hadist_8_id']);
            $table->dropForeign(['hadist_9_id']);
        });

        // drop the column
        Schema::table('siswa_hadists', function (Blueprint $table) {
            $table->dropColumn('hadist_2_id');
            $table->dropColumn('hadist_3_id');
            $table->dropColumn('hadist_4_id');
            $table->dropColumn('hadist_5_id');
            $table->dropColumn('hadist_6_id');
            $table->dropColumn('hadist_7_id');
            $table->dropColumn('hadist_8_id');
            $table->dropColumn('hadist_9_id');
        });

        // Drop the table
        Schema::dropIfExists('hadists_2');
        Schema::dropIfExists('hadists_3');
        Schema::dropIfExists('hadists_4');
        Schema::dropIfExists('hadists_5');
        Schema::dropIfExists('hadists_6');
        Schema::dropIfExists('hadists_7');
        Schema::dropIfExists('hadists_8');
        Schema::dropIfExists('hadists_9');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('hadists_2', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_3', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_4', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_5', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_6', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_7', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_8', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('hadists_9', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });



        // add the foreign key
        Schema::table('siswa_hadists', function (Blueprint $table) {
            $table->foreignId('hadist_2_id')->nullable()->references('id')->on('hadists_2');
            $table->foreignId('hadist_3_id')->nullable()->references('id')->on('hadists_3');
            $table->foreignId('hadist_4_id')->nullable()->references('id')->on('hadists_4');
            $table->foreignId('hadist_5_id')->nullable()->references('id')->on('hadists_5');
            $table->foreignId('hadist_6_id')->nullable()->references('id')->on('hadists_6');
            $table->foreignId('hadist_7_id')->nullable()->references('id')->on('hadists_7');
            $table->foreignId('hadist_8_id')->nullable()->references('id')->on('hadists_8');
            $table->foreignId('hadist_9_id')->nullable()->references('id')->on('hadists_9');
        });

        
    }
};
