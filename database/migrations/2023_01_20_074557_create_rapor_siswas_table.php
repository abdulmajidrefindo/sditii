<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rapor_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('tempat')->default('Pandeglang');
            $table->timestamp('tanggal')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapor_siswas');
    }
};