<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSekolahSeeder extends Seeder
{
    public function run()
    {
        DB::table('profil_sekolahs')->insert([
            'nama_sekolah' => "IRSYADUL 'IBAD 2 PANDEGLANG",
            'alamat_sekolah' => 'Jl. Raya Labuan Km. 40, Kp. Kaduparasi, Desa Margasana, Kec. Pagelaran, Kab. Pandeglang',
            'email_sekolah' => 'sditirsyadulibad2@gmail.com',
            'kontak_sekolah' => '081244018295',
            'website_sekolah' => 'www.sditirsyadulibad2.com',
        ]);
    }
}
