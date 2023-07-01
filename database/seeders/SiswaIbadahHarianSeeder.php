<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaIbadahHarianSeeder extends Seeder
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
            DB::table('siswa_ibadah_harians')->insert([
                'siswa_id' => $i,
                'ibadah_harian_1_id' => mt_rand(1, 4),
                'ibadah_harian_2_id' => mt_rand(1, 4),
                'ibadah_harian_3_id' => mt_rand(1, 4),
                'ibadah_harian_4_id' => mt_rand(1, 4),
                'ibadah_harian_5_id' => mt_rand(1, 4),
                'ibadah_harian_6_id' => mt_rand(1, 4),
                'ibadah_harian_7_id' => mt_rand(1, 4),
                'ibadah_harian_8_id' => mt_rand(1, 4),
                'ibadah_harian_9_id' => mt_rand(1, 4),
                // 'penilaian_deskripsi_id' => mt_rand(1, 4),
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1
            ]);
        }
    }
}