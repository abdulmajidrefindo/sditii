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
            UserRolesSeeder::class
        ]);
        User::factory(10)->create();
        Guru::factory(10)->create();
        Siswa::factory(60)->create();
        
        $this->call([
            UserSeeder::class,
            RolesSeeder::class,
            PengumumanSeeder::class,
            PeriodeSeeder::class,
            ProfilSekolahSeeder::class,
            PenilaianDeskripsiSeeder::class,
            PenilaianHurufAngkaSeeder::class,
            KelasSeeder::class,
            FormatRaporSeeder::class,
            
            IWRSeeder::class,
            SiswaIWRSeeder::class,
            
            Tahfidz1Seeder::class,
            Tahfidz2Seeder::class,
            Tahfidz3Seeder::class,
            Tahfidz4Seeder::class,
            Tahfidz5Seeder::class,
            Tahfidz6Seeder::class,
            Tahfidz7Seeder::class,
            Tahfidz8Seeder::class,
            Tahfidz9Seeder::class,
            Tahfidz10Seeder::class,
            Tahfidz11Seeder::class,
            Tahfidz12Seeder::class,
            Tahfidz13Seeder::class,
            Tahfidz14Seeder::class,
            Tahfidz15Seeder::class,
            SiswaTahfidzSeeder::class,
            
            Doa1Seeder::class,
            Doa2Seeder::class,
            Doa3Seeder::class,
            Doa4Seeder::class,
            Doa5Seeder::class,
            Doa6Seeder::class,
            Doa7Seeder::class,
            Doa8Seeder::class,
            Doa9Seeder::class,
            SiswaDoaSeeder::class,
            
            Hadist1Seeder::class,
            Hadist2Seeder::class,
            Hadist3Seeder::class,
            Hadist4Seeder::class,
            Hadist5Seeder::class,
            Hadist6Seeder::class,
            Hadist7Seeder::class,
            Hadist8Seeder::class,
            Hadist9Seeder::class,
            SiswaHadistSeeder::class,
            
            IbadahHarian1Seeder::class,
            IbadahHarian2Seeder::class,
            IbadahHarian3Seeder::class,
            IbadahHarian4Seeder::class,
            IbadahHarian5Seeder::class,
            IbadahHarian6Seeder::class,
            IbadahHarian7Seeder::class,
            IbadahHarian8Seeder::class,
            IbadahHarian9Seeder::class,
            SiswaIbadahHarianSeeder::class,

            NilaiUh1Seeder::class,
            NilaiUh2Seeder::class,
            NilaiUh3Seeder::class,
            NilaiUh4Seeder::class,
            NilaiTugas1Seeder::class,
            NilaiTugas2Seeder::class,
            NilaiUtsSeeder::class,
            NilaiPasSeeder::class,
            MapelSeeder::class,
            SiswaBidangStudiSeeder::class,
            
            RaporSiswaSeeder::class,
        ]);
    }
}
