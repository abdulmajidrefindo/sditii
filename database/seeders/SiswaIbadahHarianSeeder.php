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
        for ($i = 1; $i < 26; $i++)
        {
            for ($j = 1; $j < 4; $j++)
            {
                DB::table('siswa_ibadah_harians')->insert([
                    'siswa_id' => $i,
                    'ibadah_harian_id' => $j,
                    'penilaian_deskripsi_id' => mt_rand(1, 4),
                ]);
            }
        }
    }
}