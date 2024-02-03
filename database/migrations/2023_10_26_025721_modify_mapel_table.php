<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mapels', function (Blueprint $table) {
            $table->foreignId('kelas_id')->after('guru_id')->nullable()->references('id')->on('kelas');
        });
    }

    public function down()
    {
        Schema::table('mapels', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
