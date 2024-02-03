<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penilaian_huruf_angkas', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai_angka')->nullable();
            $table->string('nilai_huruf');
            $table->string('keterangan_angka')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_huruf_angkas');
    }
};
