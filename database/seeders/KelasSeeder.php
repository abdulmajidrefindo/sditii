<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Guru;

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
            'nama_kelas' => 'Kelas 1',
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Kelas 2',
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Kelas 3',
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Kelas 4',
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Kelas 5',
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Kelas 6',
        ]);
        DB::table('kelas')->insert([
            'nama_kelas' => 'Bukan Wali Kelas',
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'A',
            'kelas_id' => '1',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'B',
            'kelas_id' => '1',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'A',
            'kelas_id' => '2',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'B',
            'kelas_id' => '2',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'A',
            'kelas_id' => '3',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'B',
            'kelas_id' => '3',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'A',
            'kelas_id' => '4',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'B',
            'kelas_id' => '4',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'A',
            'kelas_id' => '5',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'B',
            'kelas_id' => '5',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'A',
            'kelas_id' => '6',
            'guru_id' => Guru::all()->random()->id
        ]);

        DB::table('sub_kelas')->insert([
            'nama_sub_kelas' => 'B',
            'kelas_id' => '6',
            'guru_id' => Guru::all()->random()->id
        ]);
    }
}
