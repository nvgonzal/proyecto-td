<?php

use Illuminate\Database\Seeder;
use App\Cuenta;
use Illuminate\Support\Facades\Hash;
use App\Cliente;
use App\Transportista;

class CuentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        $cuenta1 = Cuenta::create([
            'CUE_EMAIL' => 'foo@foo.com',
            'CUE_PASSWORD' => Hash::make('td12345'),
            'CUE_NOMBRES' => $faker->firstName,
            'CUE_APELL_PATERNO' => $faker->lastName,
            'CUE_APELL_MATERNO' => $faker->lastName,
            'CUE_TELEFONO' => $faker->phoneNumber,
            'CUE_RUT' => '11.111.111-1',
            'CUE_TIPO' => 'ambos',
        ]);

        Cliente::create([
            'CUE_ID' => $cuenta1->CUE_ID,
            'EMP_ID' => null,
            'CLI_VALORACION' => 0,
        ]);

        Transportista::create([
            'CUE_ID' => $cuenta1->CUE_ID,
            'TRA_VALORACION' => 0,
        ]);
    }
}
