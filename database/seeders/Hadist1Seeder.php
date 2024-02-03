<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Kelas;
use App\Models\Guru;

class Hadist1Seeder extends Seeder
{
    public function run()
    {
        $hadist = [
            'Membaca Al-Qur’an',
            'Keutamaan Jujur',
            'Menjaga Amanah',
            'Puasa',
        ];
        
        for ($i=0; $i < count($hadist); $i++) { 
            for ($j=1; $j <= Kelas::count()-1; $j++) { 
                DB::table('hadists_1')->insert([
                    'nama_nilai' => $hadist[$i],
                    'guru_id' => Guru::inRandomOrder()->first()->id,
                    'kelas_id' => $j,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'periode_id' => '1',
                ]);
            }
        }
    }
}