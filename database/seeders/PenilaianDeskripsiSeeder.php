<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianDeskripsiSeeder extends Seeder
{
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
        DB::table('penilaian_deskripsis')->insert([
            'deskripsi' => 'K',
            'keterangan' => 'Kosong'
        ]);
    }
}
