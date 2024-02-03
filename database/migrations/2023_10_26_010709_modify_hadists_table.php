<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hadists_1', function (Blueprint $table) {
            $table->dropColumn('nilai');
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropColumn('penilaian_huruf_angka_id');
            $table->foreignId('kelas_id')->after('guru_id')->nullable()->references('id')->on('kelas');
        });
    }

    public function down()
    {
        Schema::table('hadists_1', function (Blueprint $table) {
            $table->integer('nilai')->nullable();
            $table->foreignId('penilaian_huruf_angka_id')->after('id')->nullable()->references('id')->on('penilaian_huruf_angkas');
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
