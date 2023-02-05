<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HadistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hadists')->insert([
            'guru_id' => '2',
            'nama_hadist' => 'Hadist Senyum',
        ]);
        DB::table('hadists')->insert([
            'guru_id' => '2',
            'nama_hadist' => 'Hadist Puasa',
        ]);
        DB::table('hadists')->insert([
            'guru_id' => '2',
            'nama_hadist' => 'Hadist Berpakaian',
        ]);
    }
}