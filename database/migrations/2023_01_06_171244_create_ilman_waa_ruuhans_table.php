<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ilman_waa_ruuhans', function (Blueprint $table) {
            $table->id();
            $table->string('pencapaian');
            $table->integer('jilid');
            $table->integer('halaman');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ilman_waa_ruuhans');
    }
};
