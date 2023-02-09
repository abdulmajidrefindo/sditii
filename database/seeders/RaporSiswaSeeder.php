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
        // for ($i = 1; $i <= 25; $i++)
        // {
        // for ($j = 1; $j <= 75; $j++)
        // {
        // for ($k = 1; $k <= 75; $k++)
        // {
        // for ($l = 1; $l <= 75; $l++)
        // {
        // for ($m = 1; $m <= 25; $m++)
        // {
        // for ($n = 1; $n <= 225; $n++)
        // {
        // for ($o = 1; $o <= 75; $o++)
        // {
            DB::table('rapor_siswas')->insert([
                // 'siswa_id' => $i,
                // 'profil_sekolah_id' => 1,
                // 'periode_id' => 1,
                'tempat' => 'Pandeglang',
                'tanggal' => now(),
                // 'siswa_doa_id' => $j,
                // 'siswa_hadist_id' => $k,
                // 'siswa_ibadah_harian_id' => $l,
                // 'siswa_ilman_waa_ruuhan_id' => $m,
                // 'siswa_mapel_id' => $n,
                // 'siswa_tahfidz_id' => $o,
            ]);
        // }
        // }
        // }
        // }
        // }
        // }
        // }
    }
}
