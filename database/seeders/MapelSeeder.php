<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Kelas;
use App\Models\Guru;

class MapelSeeder extends Seeder
{
    public function run()
    {
        $mapel = ['Hadist',
                'Akidah',
                'Al-Qur\'an',
                'Fiqih',
                'Sejarah Kebudayaan Islam',
                'Bahasa Arab',
                'Thariqah',
                'Tafsir',
                'Tahfizh'];

        foreach ($mapel as $key => $value) {
            for ($i=1; $i <= Kelas::count()-1; $i++) { 
                DB::table('Mapels')->insert([
                    'guru_id' => Guru::all()->random()->id,
                    'nama_mapel' => $value,
                    'kelas_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'periode_id' => '1',
                ]);
            }
        }

    }
}