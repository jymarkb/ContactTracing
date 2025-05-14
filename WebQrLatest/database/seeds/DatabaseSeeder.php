<?php

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
        // $this->call(UserSeeder::class);
        $this->call([
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            BarangaySeeder::class,
            ZoneSeeder::class,
            VerificationSeeder::class,
            AdminTypeSeeder::class,
            DefaultAdminSeeder::class,
            testCitizen::class,
            testInput::class,
            ]);
    }
}
