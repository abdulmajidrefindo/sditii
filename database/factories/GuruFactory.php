<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guru>
 */
class GuruFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>mt_rand(1,10),
            'nip'=>$this->faker->unique()->randomNumber(8, true),
            'nama_guru'=>$this->faker->name(),
        ];
    }
}
