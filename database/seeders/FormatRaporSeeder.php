<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormatRaporSeeder extends Seeder
{
    public function run()
    {
        for ($i = 2; $i <= 5; $i++)
        {
            DB::table('format_rapors')->insert([
                'kelas_id' => $i,
                'format' => 'Format rapor kelas 2-5',
            ]);
        }
        DB::table('format_rapors')->insert([
            'kelas_id' => 1,
            'format' => 'Format rapor kelas 1&6',
        ]);
        DB::table('format_rapors')->insert([
            'kelas_id' => 6,
            'format' => 'Format rapor kelas 1&6',
        ]);
    }
}