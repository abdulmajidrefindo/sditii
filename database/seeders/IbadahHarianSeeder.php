<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IbadahHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ibadah_harians')->insert([
            'guru_id' => '6',
            'nama_kriteria' => 'Wudhu',
        ]);
        DB::table('ibadah_harians')->insert([
            'guru_id' => '7',
            'nama_kriteria' => 'Sholat',
        ]);
        DB::table('ibadah_harians')->insert([
            'guru_id' => '8',
            'nama_kriteria' => 'Dzikir',
        ]);
    }
}