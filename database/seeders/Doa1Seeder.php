<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Doa1Seeder extends Seeder
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
            DB::table('doas_1')->insert([
                'nama_nilai' => 'Masuk Rumah',
                'penilaian_huruf_angka_id' => ($i-101)*-1,
                'nilai' => $i,
                'guru_id' => mt_rand(1,10),
            ]);
        }
    }
}