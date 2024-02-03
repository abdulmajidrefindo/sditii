<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HadistSeeder extends Seeder
{
    public function run()
    {
        DB::table('hadists')->insert([
            'guru_id' => '5',
            'nama_hadist' => 'Hadist Senyum',
            'periode_id' => '1',
        ]);
        DB::table('hadists')->insert([
            'guru_id' => '5',
            'nama_hadist' => 'Hadist Puasa',
            'periode_id' => '1',
        ]);
        DB::table('hadists')->insert([
            'guru_id' => '5',
            'nama_hadist' => 'Hadist Berpakaian',
            'periode_id' => '1',
        ]);
    }
}