<?php

use App\Models\Ocupation;
use Illuminate\Database\Seeder;

class OcupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ocupation::create([
            'name' => 'Gerente',
            'description' => 'Tem a obrigação de gerir a organização e suas subáreas',
            'salary_id' => 1
        ]);
        Ocupation::create([
            'name' => 'Personal trainer',
            'description' => 'Treinador de musculação e aeróbica',
            'salary_id' => 3
        ]);
        Ocupation::create([
            'name' => 'Secretária(o)',
            'description' => 'Atendimento no balção',
            'salary_id' => 2
        ]);
        Ocupation::create([
            'name' => 'Outros',
            'description' => 'Função genérica',
            'salary_id' => 2
        ]);
    }
}
