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
        Schema::create('ibadah_harians_5', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->nullable();
            $table->string('nama_kriteria')->nullable();
            $table->foreignId('penilaian_deskripsi')->nullable();
            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('ibadah_harians_5');
    }
};
