<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Siswa;
use App\Models\Hadist1;
use App\Models\PenilaianHurufAngka;

class SiswaHadistSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // for ($i=1; $i <= Siswa::count(); $i++) { 
        //     for ($j = 1; $j <= Hadist1::count(); $j++)
        //     {
        //         // inser data if siswa.kelas_id == hadist.kelas_id
        //         if (Siswa::find($i)->kelas_id == Hadist1::find($j)->kelas_id) {
        //             DB::table('siswa_hadists')->insert([
        //                 'siswa_id' => $i,
        //                 'hadist_1_id' => $j,
        //                 'profil_sekolah_id' => 1,
        //                 'periode_id' => 1,
        //                 'rapor_siswa_id' => 1,
        //                 'penilaian_huruf_angka_id' => PenilaianHurufAngka::all()->random()->id
        //             ]);
        //         }

        //     }
        // }

        // $siswaHadist = Siswa::join('hadists_1', 'siswas.sub_kelas.kelas_id', '=', 'hadists_1.kelas_id')
        //                     ->select('siswas.id as siswa_id', 'hadists_1.id as hadist_1_id')
        //                     ->get();

        $siswaHadist = Siswa::join('sub_kelas', 'siswas.sub_kelas_id', '=', 'sub_kelas.id')
                                ->join('hadists_1', 'sub_kelas.kelas_id', '=', 'hadists_1.kelas_id')
                                ->select('siswas.id as siswa_id', 'hadists_1.id as hadist_1_id')
                                ->get();

        foreach ($siswaHadist as $key => $value) {
            DB::table('siswa_hadists')->insert([
                'siswa_id' => $value->siswa_id,
                'hadist_1_id' => $value->hadist_1_id,
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1,
                'penilaian_huruf_angka_id' => PenilaianHurufAngka::all()->random()->id
            ]);
        }

    }
}