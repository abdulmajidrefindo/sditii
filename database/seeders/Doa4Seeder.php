<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Doa4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 100; $i++)
        {
            DB::table('doas_4')->insert([
                'nama_nilai' => 'Makan-minum',
                'penilaian_huruf_angka' => $i,
                'nilai' => $i,
                'guru_id' => mt_rand(1,10),
            ]);
        }
    }
}