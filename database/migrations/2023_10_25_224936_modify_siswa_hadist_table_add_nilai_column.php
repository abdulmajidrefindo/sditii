<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa_hadists', function (Blueprint $table) {
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
    }

    public function down()
    {
        Schema::table('siswa_hadists', function (Blueprint $table) {
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropColumn('penilaian_huruf_angka_id');
        });
    }
};
