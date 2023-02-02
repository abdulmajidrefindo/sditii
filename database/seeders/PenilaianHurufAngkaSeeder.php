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
        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_huruf' => 'A+',
        ]);
        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_huruf' => 'A',
            
        ]);
        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_huruf' => 'B+',
            
        ]);
        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_huruf' => 'B',
            
        ]);
        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_huruf' => 'B-',
            
        ]);
        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_huruf' => 'C'
        ]);
    }
}
