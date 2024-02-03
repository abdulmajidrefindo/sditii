<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->foreign('nilai_uh_1')->references('id')->on('penilaian_huruf_angkas');
            $table->foreign('nilai_uh_2')->references('id')->on('penilaian_huruf_angkas');
            $table->foreign('nilai_uh_3')->references('id')->on('penilaian_huruf_angkas');
            $table->foreign('nilai_uh_4')->references('id')->on('penilaian_huruf_angkas');

            $table->foreign('nilai_tugas_1')->references('id')->on('penilaian_huruf_angkas');
            $table->foreign('nilai_tugas_2')->references('id')->on('penilaian_huruf_angkas');

            $table->foreign('nilai_uts')->references('id')->on('penilaian_huruf_angkas');
            $table->foreign('nilai_pas')->references('id')->on('penilaian_huruf_angkas');
        });
    }

    public function down()
    {
        Schema::table('siswa_bidang_studis', function (Blueprint $table) {
            $table->dropForeign(['nilai_uh_1'])->references('id')->on('penilaian_huruf_angkas');
            $table->dropForeign(['nilai_uh_2'])->references('id')->on('penilaian_huruf_angkas');
            $table->dropForeign(['nilai_uh_3'])->references('id')->on('penilaian_huruf_angkas');
            $table->dropForeign(['nilai_uh_4'])->references('id')->on('penilaian_huruf_angkas');

            $table->dropForeign(['nilai_tugas_1'])->references('id')->on('penilaian_huruf_angkas');
            $table->dropForeign(['nilai_tugas_2'])->references('id')->on('penilaian_huruf_angkas');

            $table->dropForeign(['nilai_uts'])->references('id')->on('penilaian_huruf_angkas');
            $table->dropForeign(['nilai_pas'])->references('id')->on('penilaian_huruf_angkas');
        });
    }
};
