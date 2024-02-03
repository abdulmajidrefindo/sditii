<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('format_rapors', function (Blueprint $table) {
            $table->id();
            $table->string('format');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('format_rapors');
    }
};
