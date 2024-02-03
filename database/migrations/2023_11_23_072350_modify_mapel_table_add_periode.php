<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('doas_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        Schema::table('hadists_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        Schema::table('ibadah_harians_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        Schema::table('tahfidzs_1', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
        Schema::table('mapels', function (Blueprint $table) {
            $table->foreignId('periode_id')->after('id')->references('id')->on('periodes')->onDelete('cascade');
        });
    }

    public function down()
    {
            Schema::table('doas_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            Schema::table('hadists_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            Schema::table('ibadah_harians_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            Schema::table('tahfidzs_1', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
            Schema::table('mapels', function (Blueprint $table) {
                $table->dropForeign(['periode_id']);
                $table->dropColumn('periode_id');
            });
    }
};
