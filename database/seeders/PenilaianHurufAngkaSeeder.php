<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianHurufAngkaSeeder extends Seeder
{
    private function keterangan_angka($number)
    {
        $satuan = array(
            0 => '',
            1 => 'satu',
            2 => 'dua',
            3 => 'tiga',
            4 => 'empat',
            5 => 'lima',
            6 => 'enam',
            7 => 'tujuh',
            8 => 'delapan',
            9 => 'sembilan',
            10 => 'sepuluh',
            11 => 'sebelas',
            12 => 'dua belas',
            13 => 'tiga belas',
            14 => 'empat belas',
            15 => 'lima belas',
            16 => 'enam belas',
            17 => 'tujuh belas',
            18 => 'delapan belas',
            19 => 'sembilan belas'
        );

        $puluhan = array(
            0 => '',
            1 => 'sepuluh',
            2 => 'dua puluh',
            3 => 'tiga puluh',
            4 => 'empat puluh',
            5 => 'lima puluh',
            6 => 'enam puluh',
            7 => 'tujuh puluh',
            8 => 'delapan puluh',
            9 => 'sembilan puluh'
        );

        $ratusan = array(
            0 => '',
            1 => 'seratus'
        );

        $words = '';

        if ($number > 0 && $number <= 100) {
            if ($number < 20) {
                $words = $satuan[$number];
            } elseif ($number >= 20 && $number < 100) {
                $words = $puluhan[floor($number / 10)] . ' ' . $satuan[$number % 10];
            } elseif ($number == 100) {
                $words = $ratusan[floor($number / 100)];
            }
        } else {
            $words = 'angka tidak valid';
        }

        $words = ucfirst($words);

        return $words;
    }
     
    public function run()
    {
        for ($i = 1; $i <= 50; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'E',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 51; $i <= 60; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'D',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 61; $i <= 65; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 66; $i <= 70; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'C+',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 71; $i <= 75; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B-',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 76; $i <= 80; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 81; $i <= 85; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'B+',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 86; $i <= 90; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        for ($i = 91; $i <= 100; $i++)
        {
            DB::table('penilaian_huruf_angkas')->insert([
                'nilai_angka' => $i,
                'nilai_huruf' => 'A+',
                'keterangan_angka' => $this->keterangan_angka($i)
            ]);
        }

        DB::table('penilaian_huruf_angkas')->insert([
            'nilai_angka' => 0,
            'nilai_huruf' => 'E',
            'keterangan_angka' =>  'Kosong'
        ]);
    }
}
