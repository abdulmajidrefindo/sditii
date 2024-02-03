<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'Administrator',
        ]);
        DB::table('roles')->insert([
            'role' => 'Wali Kelas',
        ]);
        DB::table('roles')->insert([
            'role' => 'Guru'
        ]);
    }
}
