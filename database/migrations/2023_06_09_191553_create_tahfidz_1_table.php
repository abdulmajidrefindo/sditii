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
        Schema::create('tahfidzs_1', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->foreignId('penilaian_huruf_angka')->nullable();
            $table->integer('nilai')->nullable();
            $table->foreignId('guru_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahfidzs_1');
    }
};
