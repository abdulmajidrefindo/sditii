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
        for ($i = 1; $i <= 50; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'E',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 51; $i <= 60; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'D',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 61; $i <= 65; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 66; $i <= 70; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C+',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 71; $i <= 75; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B-',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 76; $i <= 80; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 81; $i <= 85; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B+',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 86; $i <= 90; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        for ($i = 91; $i <= 100; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A+',
                'keterangan_angka' => '-kosong-'
            ]);
        }

        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_angka' => 0,
            'nilai_huruf' => 'E',
            'keterangan_angka' => '-kosong-'
        ]);

        
        
        
        
        
        
        
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
