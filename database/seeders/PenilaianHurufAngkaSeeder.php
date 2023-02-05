<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PenilaianHurufAngkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 100; $i > 0; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A+',
                'keterangan_angka' => 'Belum dibikin satu-satu :('
            ]);
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A',
                'keterangan_angka' => 'Belum dibikin satu-satu :('
            ]);
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B+',
                'keterangan_angka' => 'Belum dibikin satu-satu :('
            ]);
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B',
                'keterangan_angka' => 'Belum dibikin satu-satu :('
            ]);
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B-',
                'keterangan_angka' => 'Belum dibikin satu-satu :('                
            ]);
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C',
                'keterangan_angka' => 'Belum dibikin satu-satu :('
            ]);
        }
    }
}
