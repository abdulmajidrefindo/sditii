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
        Guru::factory(10)->create();
        User::factory(10)->create();
        Siswa::factory(60)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PengumumanSeeder::class,
            UserSeeder::class,
            RolesSeeder::class,
            UserRolesSeeder::class,
            PeriodeSeeder::class,
            ProfilSekolahSeeder::class,
            PenilaianDeskripsiSeeder::class,
            PenilaianHurufAngkaSeeder::class,
            KelasSeeder::class,
            IbadahHarianSeeder::class,
            SiswaIbadahHarianSeeder::class,
            TahfidzSeeder::class,
            SiswaTahfidzSeeder::class,
            HadistSeeder::class,
            SiswaHadistSeeder::class,
            DoaSeeder::class,
            SiswaDoaSeeder::class,
            IWRSeeder::class,
            SiswaIWRSeeder::class,
            BidangStudiSeeder::class,
            TugasMapelSeeder::class,
            SiswaMapelSeeder::class,
        ]);
    }
}
