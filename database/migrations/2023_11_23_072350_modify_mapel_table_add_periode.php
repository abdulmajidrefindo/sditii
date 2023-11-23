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
        //add periode_id to doas_1
        Schema::table('doas_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        //add periode_id to hadists_1
        Schema::table('hadists_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        //add periode_id to ibadah_harians_1
        Schema::table('ibadah_harians_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        //add periode_id to tahfidzs_1
        Schema::table('tahfidzs_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        //add periode_id to mapels
        Schema::table('mapels', function (Blueprint $table) {
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
            //drop periode_id from doas_1
            Schema::table('doas_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            //drop periode_id from hadists_1
            Schema::table('hadists_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            //drop periode_id from ibadah_harians_1
            Schema::table('ibadah_harians_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            //drop periode_id from tahfidzs_1
            Schema::table('tahfidzs_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            //drop periode_id from mapels
            Schema::table('mapels', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
    }
};
