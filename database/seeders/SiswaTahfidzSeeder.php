<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Tahfidz1;
use App\Models\Siswa;
use App\Models\PenilaianHurufAngka;

class SiswaTahfidzSeeder extends Seeder
{
    public function run()
    {
        $siswaTahfidz = Siswa::join('sub_kelas', 'siswas.sub_kelas_id', '=', 'sub_kelas.id')
                                ->join('tahfidzs_1', 'sub_kelas.kelas_id', '=', 'tahfidzs_1.kelas_id')
                                ->select('siswas.id as siswa_id', 'tahfidzs_1.id as tahfidz_1_id')
                                ->get();

        foreach ($siswaTahfidz as $key => $value) {
            DB::table('siswa_tahfidzs')->insert([
                'siswa_id' => $value->siswa_id,
                'tahfidz_1_id' => $value->tahfidz_1_id,
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1,
                'penilaian_huruf_angka_id' => PenilaianHurufAngka::all()->random()->id
            ]);
        }
    }
}