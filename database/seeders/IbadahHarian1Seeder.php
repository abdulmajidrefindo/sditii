<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Guru;
use App\Models\Kelas;

class IbadahHarian1Seeder extends Seeder
{
    public function run()
    {
        $ibadah = [
            'Sholat',
            'Puasa',
            'Zakat',
            'Haji',
            'Tilawah',
            'Hafalan Doa',
            'Hafalan Hadist',
        ];

        foreach ($ibadah as $key => $value) {
            for ($i=1; $i <= Kelas::count()-1; $i++) { 
                DB::table('ibadah_harians_1')->insert([
                    'nama_kriteria' => $value,
                    'guru_id' => Guru::inRandomOrder()->first()->id,
                    'kelas_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'periode_id' => '1',
                ]);
            }
        }
    }
}