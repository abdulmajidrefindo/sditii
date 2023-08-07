<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($h = 1; $h <= 3; $h++) { 
            DB::table('user_roles')->insert([
                'user_id' => $h,
                'role_id' => '1'
            ]);
        }
        for ($i = 4; $i <= 8; $i++) { 
            DB::table('user_roles')->insert([
                'user_id' => $i,
                'role_id' => '2',
            ]);
        } 
        for ($j = 9; $j <= 13; $j++) { 
            DB::table('user_roles')->insert([
                'user_id' => $j,
                'role_id' => '3',
            ]);
        } 
    }
}
