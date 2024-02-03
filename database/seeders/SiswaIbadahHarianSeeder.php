<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Siswa;
use App\Models\IbadahHarian1;
use App\Models\PenilaianDeskripsi;

class SiswaIbadahHarianSeeder extends Seeder
{
    public function run()
    {
        $siswaIbadahHarian = Siswa::join('sub_kelas', 'siswas.sub_kelas_id', '=', 'sub_kelas.id')
                                ->join('ibadah_harians_1', 'sub_kelas.kelas_id', '=', 'ibadah_harians_1.kelas_id')
                                ->select('siswas.id as siswa_id', 'ibadah_harians_1.id as ibadah_harian_1_id')
                                ->get();

        foreach ($siswaIbadahHarian as $key => $value) {
            DB::table('siswa_ibadah_harians')->insert([
                'siswa_id' => $value->siswa_id,
                'ibadah_harian_1_id' => $value->ibadah_harian_1_id,
                'profil_sekolah_id' => 1,
                'periode_id' => 1,
                'rapor_siswa_id' => 1,
                'penilaian_deskripsi_id' => PenilaianDeskripsi::all()->random()->id
            ]);
        }
    }
}