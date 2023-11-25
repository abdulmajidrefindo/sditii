<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Siswa;
use App\Models\IlmanWaaRuuhan;
use App\Models\PenilaianDeskripsi;
use App\Models\PenilaianHurufAngka;


class SiswaIWRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= Siswa::count(); $i++)
        {
            {
                DB::table('siswa_ilman_waa_ruuhans')->insert([
                    'siswa_id' => $i,
                    'ilman_waa_ruuhan_id' => 1,
                    'penilaian_deskripsi_id' => PenilaianDeskripsi::all()->random()->id,
                    'penilaian_huruf_angka_id' => PenilaianHurufAngka::all()->random()->id,
                    'profil_sekolah_id' => 1,
                    'periode_id' => 1,
                    'rapor_siswa_id' => 1,
                    'jilid' => rand(1, 5),
                    'halaman' => rand(1, 10),
                ]);
            }
        }
    }
}