<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaporSiswaSeeder extends Seeder
{
    public function run()
    {
            DB::table('rapor_siswas')->insert([
                'tempat' => 'Pandeglang',
                'tanggal' => now(),
            ]);
    }
}
