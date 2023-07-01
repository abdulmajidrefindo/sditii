<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaHadistSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        for ($i = 1; $i <= 60; $i++)
        {
            DB::table('siswa_hadists')->insert([
                'siswa_id' => $i,
                'hadist_1_id' => mt_rand(1, 101),
                'hadist_2_id' => mt_rand(1, 101),
                'hadist_3_id' => mt_rand(1, 101),
                'hadist_4_id' => mt_rand(1, 101),
                'hadist_5_id' => mt_rand(1, 101),
                'hadist_6_id' => mt_rand(1, 101),
                'hadist_7_id' => mt_rand(1, 101),
                'hadist_8_id' => mt_rand(1, 101),
                'hadist_9_id' => mt_rand(1, 101),
                // 'nilai_angka' => mt_rand(0, 100),
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1
            ]);
        }
    }
}