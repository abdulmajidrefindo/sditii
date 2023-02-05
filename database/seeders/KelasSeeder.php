<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            'guru_id' => '4',
            'nama_kelas' => 'Kelas 1',
        ]);
        DB::table('kelas')->insert([
            'guru_id' => '5',
            'nama_kelas' => 'Kelas 2',
        ]);
        DB::table('kelas')->insert([
            'guru_id' => '6',
            'nama_kelas' => 'Kelas 3',
        ]);
        DB::table('kelas')->insert([
            'guru_id' => '7',
            'nama_kelas' => 'Kelas 4',
        ]);
        DB::table('kelas')->insert([
            'guru_id' => '8',
            'nama_kelas' => 'Kelas 5',
        ]);
        DB::table('kelas')->insert([
            'guru_id' => '9',
            'nama_kelas' => 'Kelas 6',
        ]);
    }
}
