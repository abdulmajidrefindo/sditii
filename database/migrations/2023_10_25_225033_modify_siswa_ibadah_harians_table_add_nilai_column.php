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
        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            $table->foreignId('penilaian_deskripsi_id')->nullable()->references('id')->on('penilaian_deskripsis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify table siswa_ibadah_harians, drop nilai column
        Schema::table('siswa_ibadah_harians', function (Blueprint $table) {
            $table->dropForeign(['penilaian_deskripsi_id']);
            $table->dropColumn('penilaian_deskripsi_id');
        });
    }
};
