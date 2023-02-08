<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RaporSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 25; $i++)
        {
            DB::table('rapor_siswas')->insert([
                'siswa_id' => $i,
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'tempat' => 'Pandeglang',
                'tanggal' => now(),
            ]);
        }
    }
}
