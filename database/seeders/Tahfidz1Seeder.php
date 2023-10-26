<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Tahfidz1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suratJuz30 = [
            'Al-Fatihah',
            'An-Naba',
            'An-Nazi\'at',
            'Abasa',
            'At-Takwir',
            'Al-Infitar',
            'At-Tatfif',
            'Al-Insyiqaq',
            'Al-Buruj',
            'At-Tariq',
            'Al-A\'la',
            'Al-Gasyiyah',
            'Al-Fajr',
            'Al-Balad',
            'Asy-Syams',
            'Al-Lail',
            'Ad-Duha',
            'Asy-Syarh',
            'At-Tin',
            'Al-\'Alaq',
            'Al-Qadr',
            'Al-Bayyinah',
            'Az-Zalzalah',
            'Al-\'Adiyat',
            'Al-Qari\'ah',
            'At-Takasur',
            'Al-Asr',
            'Al-Humazah',
            'Al-Fil',
            'Quraisy',
            'Al-Ma\'un',
            'Al-Kausar',
            'Al-Kafirun',
            'An-Nasr',
            'Al-Lahab',
            'Al-Ikhlas',
            'Al-Falaq',
            'An-Nas'
        ];
        
        for ($i=0; $i < count($suratJuz30); $i++) { 
            DB::table('tahfidzs_1')->insert([
                'nama_nilai' => $suratJuz30[$i],
                'penilaian_huruf_angka_id' => mt_rand(1,100),
                'nilai' => $i,
                'guru_id' => mt_rand(1,10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }


        
    }
}