<?php

namespace Database\Seeders;
use App\Models\Roles;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Models\SiswaMapel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);
        User::factory(10)->create();
        Guru::factory(10)->create();
        $this->call([
            RaporSiswaSeeder::class,
            KelasSeeder::class
        ]);

        Siswa::factory(160)->create();
        
        $this->call([
            RolesSeeder::class,
            UserRolesSeeder::class,
            PengumumanSeeder::class,
            PeriodeSeeder::class,
            ProfilSekolahSeeder::class,
            PenilaianDeskripsiSeeder::class,
            PenilaianHurufAngkaSeeder::class,
            FormatRaporSeeder::class,
            
            IWRSeeder::class,
            SiswaIWRSeeder::class,
            
            Tahfidz1Seeder::class,
            SiswaTahfidzSeeder::class,
            
            Doa1Seeder::class,
            SiswaDoaSeeder::class,
            
            Hadist1Seeder::class,
            SiswaHadistSeeder::class,
            
            IbadahHarian1Seeder::class,
            SiswaIbadahHarianSeeder::class,

            MapelSeeder::class,
            SiswaBidangStudiSeeder::class,
        ]);
    }
}
