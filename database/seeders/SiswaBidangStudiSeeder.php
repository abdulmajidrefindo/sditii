<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Siswa;
use App\Models\Mapel;

use App\Models\SubKelas;

class SiswaBidangStudiSeeder extends Seeder
{
    public function run()
    {
        $siswaBidangStudi = Siswa::join('sub_kelas', 'siswas.sub_kelas_id', '=', 'sub_kelas.id')
                            ->join('mapels', 'sub_kelas.kelas_id', '=', 'mapels.kelas_id')
                            ->select('siswas.id as siswa_id', 'mapels.id as mapel_id')
                            ->get();

        foreach ($siswaBidangStudi as $key => $value) {
            DB::table('siswa_bidang_studis')->insert([
                'siswa_id' => $value->siswa_id,
                'mapel_id' => $value->mapel_id,
                'nilai_uh_1' => mt_rand(1, 101),
                'nilai_uh_2' => mt_rand(1, 101),
                'nilai_uh_3' => mt_rand(1, 101),
                'nilai_uh_4' => mt_rand(1, 101),
                'nilai_tugas_1' => mt_rand(1, 101),
                'nilai_tugas_2' => mt_rand(1, 101),
                'nilai_uts' => mt_rand(1, 101),
                'nilai_pas' => mt_rand(1, 101),
                'nilai_akhir' => mt_rand(1, 101),
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1
            ]);
        }
    }
}