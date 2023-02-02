<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profil_sekolahs')->insert([
            'nama_sekolah' => 'SDIT Irsyadul Ibad 2',
            'alamat_sekolah' => 'Pandeglang',
            'email_sekolah' => 'sditirsyadulibad2@gmail.com',
            'kontak_sekolah' => '081244018295',
            'website_sekolah' => 'www.sditirsyadulibad2.com',
        ]);
    }
}
