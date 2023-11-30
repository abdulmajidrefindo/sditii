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
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });

        Schema::table('sub_kelas', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('sub_kelas', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');
        });
        
        Schema::table('ilman_waa_ruuhans', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');
        });
    }
};
