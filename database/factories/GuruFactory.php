<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuruFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id'=>mt_rand(1,10),
            'nip'=>$this->faker->unique()->randomNumber(8, true),
            'nama_guru'=>$this->faker->name(),
        ];
    }
}
