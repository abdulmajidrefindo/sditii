<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TugasMapelSeeder extends Seeder
{
    public function run()
    {
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 1,
            'nama_tugas_mapel' => 'Tugas Harian',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 1,
            'nama_tugas_mapel' => 'UTS',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 1,
            'nama_tugas_mapel' => 'UAS',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 2,
            'nama_tugas_mapel' => 'Tugas Harian',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 2,
            'nama_tugas_mapel' => 'UTS',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 2,
            'nama_tugas_mapel' => 'UAS',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 3,
            'nama_tugas_mapel' => 'Tugas Harian',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 3,
            'nama_tugas_mapel' => 'UTS',
        ]);
        DB::table('tugas_mapels')->insert([
            'bidang_studi_id' => 3,
            'nama_tugas_mapel' => 'UAS',
        ]);
    }
}