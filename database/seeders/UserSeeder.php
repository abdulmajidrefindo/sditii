<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pm=bcrypt(123456);
        DB::table('user')->insert([
            'name' => 'Master',
            'user_name' => 'master',
            'email' => 'master@gmail.com',
            'password' => "$pm",
            // 'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
        $p1=bcrypt(111111);
        DB::table('user')->insert([
            'name' => 'Admin 1',
            'user_name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => "$p1",
            // 'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
        $p2=bcrypt(222222);
        DB::table('user')->insert([
            'name' => 'Admin 2',
            'user_name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => "$p2",
            // 'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
    }
}
