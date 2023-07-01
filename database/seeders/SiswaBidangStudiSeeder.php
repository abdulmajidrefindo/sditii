<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaBidangStudiSeeder extends Seeder
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
            for ($j = 1; $j <= 7; $j++)
            {
                DB::table('siswa_bidang_studis')->insert([
                    'siswa_id' => $i,
                    'mapel_id' => $j,
                    'nilai_uh_1_id' => mt_rand(1, 101),
                    'nilai_uh_2_id' => mt_rand(1, 101),
                    'nilai_uh_3_id' => mt_rand(1, 101),
                    'nilai_uh_4_id' => mt_rand(1, 101),
                    'nilai_tugas_1_id' => mt_rand(1, 101),
                    'nilai_tugas_2_id' => mt_rand(1, 101),
                    'nilai_uts_id' => mt_rand(1, 101),
                    'nilai_pas_id' => mt_rand(1, 101),
                    'profil_sekolah_id' => 1,
                    'periode_id' => 1,
                    'rapor_siswa_id' => 1
                ]);
            }
        }
    }
}