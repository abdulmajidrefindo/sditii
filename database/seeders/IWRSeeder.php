<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IWRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++)
        {
            for ($j = 1; $j < 11; $j++)
            {
                DB::table('ilman_waa_ruuhans')->insert([
                    'guru_id' => '10',
                    'pencapaian' => 'Ilman Waa Ruuhan',
                    'jilid' => $i,    
                    'halaman' => $j,
                ]);
            }
        }
    }
}