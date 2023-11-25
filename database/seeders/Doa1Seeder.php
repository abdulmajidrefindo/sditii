<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Kelas;
use App\Models\Guru;

class Doa1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Doa = [
            'Doa Makan',
            'Doa Makan',
            'Doa Tidur',
            'Doa Bangun',
        ];

        for ($i=0; $i < count($Doa); $i++) { 
            for ($j=1; $j <= Kelas::count()-1; $j++) { 
                DB::table('doas_1')->insert([
                    'nama_nilai' => $Doa[$i],
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