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
        ]);
        DB::table('user')->insert([
            'name' => 'Ibnu Sina',
            'user_name' => 'ibnusina',
            'email' => 'ibnusina@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => now(),
        ]);
        DB::table('user')->insert([
            'name' => 'Tan Malaka',
            'user_name' => 'tanmalaka',
            'email' => 'tanmalaka@gmail.com',
            'password' => bcrypt('12345'),
            'email_verified_at' => now(),
        ]);
    }
}
