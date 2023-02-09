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
        DB::table('user_roles')->insert([
            'user_id' => '1',
            'role_id' => '1'
        ]);
        for ($i = 4; $i < 10; $i++) { 
            DB::table('user_roles')->insert([
                'user_id' => $i,
                'role_id' => '2',
            ]);
        } 
        for ($j = 4; $j < 14; $j++) { 
            DB::table('user_roles')->insert([
                'user_id' => $j,
                'role_id' => '3',
            ]);
        } 
    }
}
