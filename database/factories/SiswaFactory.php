<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\SubKelas;

class SiswaFactory extends Factory
{
    public function definition()
    {
        return [
            'nisn'=>$this->faker->unique()->randomNumber(5, true),
            'nama_siswa'=>$this->faker->name(),
            'orangtua_wali'=>$this->faker->name(),
            'rapor_siswa_id'=>1,
            'sub_kelas_id'=>SubKelas::all()->random()->id,
            'periode_id'=>1,
        ];
    }
}
