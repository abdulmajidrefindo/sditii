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
        // Modify table siswa_doas, add nilai column

        // add penilaian_huruf_angka_id column

        Schema::table('siswa_doas', function (Blueprint $table) {
            $table->foreignId('penilaian_huruf_angka_id')->nullable()->references('id')->on('penilaian_huruf_angkas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Modify table siswa_doas, drop nilai column
        Schema::table('siswa_doas', function (Blueprint $table) {
            //unlink foreign key
            $table->dropForeign(['penilaian_huruf_angka_id']);
            $table->dropColumn('penilaian_huruf_angka_id');

        });
    }
};
