<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        for ($h = 1; $h <= 3; $h++) { 
            DB::table('user_roles')->insert([
                'user_id' => $h,
                'role_id' => '1'
            ]);
        }
    }
}
