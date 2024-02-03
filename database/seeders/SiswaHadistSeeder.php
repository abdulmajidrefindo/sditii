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
    public function run()
    {
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