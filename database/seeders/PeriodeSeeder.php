<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    public function run()
    {
        DB::table('periodes')->insert([
            'semester' => '1',
            'tahun_ajaran' => '2023/2024',
            'status' => 'tidak aktif'
        ]);
        DB::table('periodes')->insert([
            'semester' => '2',
            'tahun_ajaran' => '2023/2024',
            'status' => 'aktif'
        ]);
        DB::table('periodes')->insert([
            'semester' => '1',
            'tahun_ajaran' => '2024/2025',
            'status' => 'tidak aktif'
        ]);
        DB::table('periodes')->insert([
            'semester' => '2',
            'tahun_ajaran' => '2024/2025',
            'status' => 'tidak aktif'
        ]);
    }
}
