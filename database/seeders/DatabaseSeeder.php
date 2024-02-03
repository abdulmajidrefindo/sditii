<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RaporSiswaSeeder::class,
            PeriodeSeeder::class,
            KelasSeeder::class
        ]);
        
        $this->call([
            RolesSeeder::class,
            UserRolesSeeder::class,
            ProfilSekolahSeeder::class,
            PenilaianDeskripsiSeeder::class,
            PenilaianHurufAngkaSeeder::class,
            FormatRaporSeeder::class
        ]);
    }
}
