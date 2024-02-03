<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ibadah_harians_1', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria')->nullable();
            $table->string('nilai')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ibadah_harians_1');
    }
};
