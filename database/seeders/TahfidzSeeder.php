<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TahfidzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahfidzs')->insert([
            'guru_id' => '4',
            'nama_surat' => 'An-Nas',
        ]);
        DB::table('tahfidzs')->insert([
            'guru_id' => '4',
            'nama_surat' => 'An-Ikhlas',
        ]);
        DB::table('tahfidzs')->insert([
            'guru_id' => '4',
            'nama_surat' => 'An-Falaq',
        ]);
    }
}