<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periodes')->insert([
            'semester' => '1',
            'tahun_ajaran' => '2021/2022',
            'status' => 'tidak aktif'
        ]);
        DB::table('periodes')->insert([
            'semester' => '2',
            'tahun_ajaran' => '2021/2022',
            'status' => 'tidak aktif'
        ]);
        DB::table('periodes')->insert([
            'semester' => '1',
            'tahun_ajaran' => '2022/2023',
            'status' => 'tidak aktif'
        ]);
        DB::table('periodes')->insert([
            'semester' => '2',
            'tahun_ajaran' => '2022/2023',
            'status' => 'aktif'
        ]);
    }
}
