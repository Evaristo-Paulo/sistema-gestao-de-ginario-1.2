<?php

use App\Models\Salary;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salary::create([
            'value' => 150000
        ]);
        Salary::create([
            'value' => 35000
        ]);
        Salary::create([
            'value' => 60000
        ]);
    }
}
