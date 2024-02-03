<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BidangStudiSeeder extends Seeder
{
    public function run()
    {
        DB::table('bidang_studis')->insert([
            'guru_id' => '4',
            'nama_mapel' => 'Bahasa Arab',
            'periode_id' => '1',
        ]);
        DB::table('bidang_studis')->insert([
            'guru_id' => '5',
            'nama_mapel' => 'Aqidah',
            'periode_id' => '1',
        ]);
        DB::table('bidang_studis')->insert([
            'guru_id' => '6',
            'nama_mapel' => 'Sejarah Islam',
            'periode_id' => '1',
        ]);
    }
}