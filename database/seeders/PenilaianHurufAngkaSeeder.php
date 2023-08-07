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
        for ($i = 100; $i >= 91; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A+',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 90; $i >= 86; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 85; $i >= 81; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B+',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 80; $i >= 76; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 75; $i >= 71; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B-',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 70; $i >= 66; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C+',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 65; $i >= 61; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 60; $i >= 51; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'D',
                'keterangan_angka' => '-kosong-'
            ]);
        }
        for ($i = 50; $i >= 0; $i--)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'E',
                'keterangan_angka' => '-kosong-'
            ]);
        }
            // DB::table('penilaian_huruf_angkas')->insert([
            //     'nilai_angka' => $i,
            //     'nilai_huruf' => 'A',
            //     'keterangan_angka' => 'Belum dibikin satu-satu :('
            // ]);
            // DB::table('penilaian_huruf_angkas')->insert([
            //     'nilai_angka' => $i,
            //     'nilai_huruf' => 'B+',
            //     'keterangan_angka' => 'Belum dibikin satu-satu :('
            // ]);
            // DB::table('penilaian_huruf_angkas')->insert([
            //     'nilai_angka' => $i,
            //     'nilai_huruf' => 'B',
            //     'keterangan_angka' => 'Belum dibikin satu-satu :('
            // ]);
            // DB::table('penilaian_huruf_angkas')->insert([
            //     'nilai_angka' => $i,
            //     'nilai_huruf' => 'B-',
            //     'keterangan_angka' => 'Belum dibikin satu-satu :('                
            // ]);
            // DB::table('penilaian_huruf_angkas')->insert([
            //     'nilai_angka' => $i,
            //     'nilai_huruf' => 'C',
            //     'keterangan_angka' => 'Belum dibikin satu-satu :('
            // ]);
    }
}
