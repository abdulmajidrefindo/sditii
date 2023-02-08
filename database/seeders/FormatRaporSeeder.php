<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormatRaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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