<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Al-Quran',
        ]);
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Hadist',
        ]);
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Akidah',
        ]);
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Akhlak',
        ]);
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Fiqih',
        ]);
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Thariq Islam',
        ]);
        DB::table('Mapels')->insert([
            'guru_id' => mt_rand(1,10),
            'nama_mapel' => 'Bahasa Arab',
        ]);
    }
}