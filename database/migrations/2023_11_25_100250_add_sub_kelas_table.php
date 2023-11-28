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
        Schema::create("sub_kelas", function (Blueprint $table) {
            $table->id();
            $table->string('nama_sub_kelas')->nullable();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('kelas',function(Blueprint $table){
            $table->dropForeign(['guru_id']);
            $table->dropColumn(['guru_id']);
        });
        
        Schema::table('siswas',function(Blueprint $table){
            //nullable
            $table->foreignId('sub_kelas_id')->nullable()->constrained('sub_kelas')->onDelete('cascade');
            $table->dropForeign(['kelas_id']);
            $table->dropColumn(['kelas_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

            Schema::table('siswas',function(Blueprint $table){
                $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
                $table->dropForeign(['sub_kelas_id']);
                $table->dropColumn(['sub_kelas_id']);
            });

            Schema::table('kelas',function(Blueprint $table){
                $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('cascade');
            });

            Schema::dropIfExists('sub_kelas');

            
    }
};
