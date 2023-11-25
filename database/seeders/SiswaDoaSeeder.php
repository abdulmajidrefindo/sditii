<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Siswa;
use App\Models\Doa1;
use App\Models\PenilaianHurufAngka;

class SiswaDoaSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // for ($i = 1; $i <= Siswa::count(); $i++) { 
        //     for ($j = 1; $j <= Doa1::count(); $j++)
        //     {
        //         DB::table('siswa_doas')->insert([
        //             'siswa_id' => $i,
        //             'doa_1_id' => $j,
        //             'profil_sekolah_id' => 1,
        //             'periode_id' => 1,
        //             'rapor_siswa_id' => 1,
        //             'penilaian_huruf_angka_id' => PenilaianHurufAngka::all()->random()->id
        //         ]);
        //     }
        // }

        // $siswaDoa = Siswa::join('doas_1', 'siswas.sub_kelas.kelas_id', '=', 'doas_1.kelas_id')
        //                     ->select('siswas.id as siswa_id', 'doas_1.id as doa_1_id')
        //                     ->get();

        $siswaDoa = Siswa::join('sub_kelas', 'siswas.sub_kelas_id', '=', 'sub_kelas.id')
                                ->join('doas_1', 'sub_kelas.kelas_id', '=', 'doas_1.kelas_id')
                                ->select('siswas.id as siswa_id', 'doas_1.id as doa_1_id')
                                ->get();

        foreach ($siswaDoa as $key => $value) {
            DB::table('siswa_doas')->insert([
                'siswa_id' => $value->siswa_id,
                'doa_1_id' => $value->doa_1_id,
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1,
                'penilaian_huruf_angka_id' => PenilaianHurufAngka::all()->random()->id
            ]);
        }
    }
}