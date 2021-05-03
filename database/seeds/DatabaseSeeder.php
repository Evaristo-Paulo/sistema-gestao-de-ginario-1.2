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
        $this->call(GenderSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(MunicipeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SalarySeeder::class);
        $this->call(OcupationSeeder::class);
        $this->call(MonthSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
