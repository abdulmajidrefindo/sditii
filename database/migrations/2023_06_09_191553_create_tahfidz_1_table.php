<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tahfidzs_1', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nilai')->nullable();
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahfidzs_1');
    }
};
