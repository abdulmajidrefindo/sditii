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
        // drop nilai columns
        Schema::table('doas_1', function (Blueprint $table) {
            $table->dropColumn('nilai');
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropColumn('penilaian_huruf_angka_id');
            // add kelas_id column
            $table->foreignId('kelas_id')->after('guru_id')->nullable()->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('doas_1', function (Blueprint $table) {
        // add nilai column
        $table->integer('nilai')->nullable();
        // add penilaian_huruf_angka_id column
        $table->foreignId('penilaian_huruf_angka_id')->after('id')->nullable()->references('id')->on('penilaian_huruf_angka');
        // drop kelas_id column
        $table->dropForeign(['kelas_id']);
        $table->dropColumn('kelas_id');
    });
    }
};
