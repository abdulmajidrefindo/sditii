<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PenilaianDeskripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penilaian_deskripsis')->insert([
            'deskripsi' => 'BT',
            'keterangan' => 'Belum Terlihat'
        ]);
        DB::table('penilaian_deskripsis')->insert([
            'deskripsi' => 'MT',
            'keterangan' => 'Mulai Terlihat'
        ]);
        DB::table('penilaian_deskripsis')->insert([
            'deskripsi' => 'MB',
            'keterangan' => 'Mulai Berkembang'
        ]);
        DB::table('penilaian_deskripsis')->insert([
            'deskripsi' => 'MK',
            'keterangan' => 'Menjadi Kebiasaan'
        ]);
    }
}
