<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaMapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 26; $i++)
        {
            for ($j = 1; $j < 10; $j++)
            {
                DB::table('siswa_mapels')->insert([
                    'siswa_id' => $i,
                    'tugas_mapel_id' => $j,
                    'penilaian_huruf_angka_id' => mt_rand(1, 100),
                    'profil_sekolah_id' => 1,
                    'periode_id' => 1,
                    'rapor_siswa_id' => 1
                ]);
            }
        }
    }
}