<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengumumen')->insert([
            'judul' => 'Ganti Password',
            'isi' => 'Untuk memastikan keamanan, pengguna baru harap segera mengubah password!',
            'user_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            'publishet_at' => now(),
        ]);
    }
}
