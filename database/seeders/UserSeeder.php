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
        DB::table('user')->insert([
            'name' => 'Abdul Majid Refindo',
            'user_name' => 'abdulmajidrefindo',
            'email' => 'abdulmajirefindo@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
        DB::table('user')->insert([
            'name' => 'My Admin',
            'user_name' => 'myadmin',
            'email' => 'myadmin@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at'=>now()
        ]);
    }
}
