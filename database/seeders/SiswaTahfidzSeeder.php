<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaTahfidzSeeder extends Seeder
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
                DB::table('siswa_tahfidzs')->insert([
                    'siswa_id' => $i,
                    'tahfidz_1_id' => mt_rand(1, 101),
                    'tahfidz_2_id' => mt_rand(1, 101),
                    'tahfidz_3_id' => mt_rand(1, 101),
                    'tahfidz_4_id' => mt_rand(1, 101),
                    'tahfidz_5_id' => mt_rand(1, 101),
                    'tahfidz_6_id' => mt_rand(1, 101),
                    'tahfidz_7_id' => mt_rand(1, 101),
                    'tahfidz_8_id' => mt_rand(1, 101),
                    'tahfidz_9_id' => mt_rand(1, 101),
                    'tahfidz_10_id' => mt_rand(1, 101),
                    'tahfidz_11_id' => mt_rand(1, 101),
                    'tahfidz_12_id' => mt_rand(1, 101),
                    'tahfidz_13_id' => mt_rand(1, 101),
                    'tahfidz_14_id' => mt_rand(1, 101),
                    'tahfidz_15_id' => mt_rand(1, 101),
                    // 'nilai_angka' => mt_rand(0, 100),
                    'profil_sekolah_id' => 1,
                    'periode_id' => 1,
                    'rapor_siswa_id' => 1
                ]);
        }
    }
}