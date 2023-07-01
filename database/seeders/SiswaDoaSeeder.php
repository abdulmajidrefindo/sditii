<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaDoaSeeder extends Seeder
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
            DB::table('siswa_doas')->insert([
                'siswa_id' => $i,
                'doa_1_id' => mt_rand(1, 101),
                'doa_2_id' => mt_rand(1, 101),
                'doa_3_id' => mt_rand(1, 101),
                'doa_4_id' => mt_rand(1, 101),
                'doa_5_id' => mt_rand(1, 101),
                'doa_6_id' => mt_rand(1, 101),
                'doa_7_id' => mt_rand(1, 101),
                'doa_8_id' => mt_rand(1, 101),
                'doa_9_id' => mt_rand(1, 101),
                // 'nilai_angka' => mt_rand(0, 100),
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1
            ]);
        }
    }
}