<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doas')->insert([
            'guru_id' => '8',
            'nama_doa' => 'Doa Makan',
        ]);
        DB::table('Doas')->insert([
            'guru_id' => '8',
            'nama_doa' => 'Doa Berkendara',
        ]);
        DB::table('Doas')->insert([
            'guru_id' => '8',
            'nama_doa' => 'Doa Tidur',
        ]);
    }
}