<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $pm=bcrypt(123456);
        DB::table('user')->insert([
            'name' => 'Master',
            'user_name' => 'master',
            'email' => 'master@gmail.com',
            'password' => "$pm",
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
        $p1=bcrypt(111111);
        DB::table('user')->insert([
            'name' => 'Admin 1',
            'user_name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => "$p1",
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
        $p2=bcrypt(222222);
        DB::table('user')->insert([
            'name' => 'Admin 2',
            'user_name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => "$p2",
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
    }
}
