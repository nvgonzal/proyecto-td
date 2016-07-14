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

        $nombre = $faker->firstName;
        $apell_paterno = $faker->lastName;
        $apell_materno = $faker->lastName;
        $nombre_completo = $nombre . ' ' . $apell_paterno . ' ' . $apell_materno;
        $cuenta1 = Cuenta::create([
            'CUE_EMAIL' => 'foo@foo.com',
            'CUE_PASSWORD' => Hash::make('td12345'),
            'CUE_NOMBRES' => $nombre,
            'CUE_APELL_PATERNO' => $apell_paterno,
            'CUE_APELL_MATERNO' => $apell_materno,
            'CUE_NOMBRE_COMPLETO' => $nombre_completo,
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

        $nombre = $faker->firstName;
        $apell_paterno = $faker->lastName;
        $apell_materno = $faker->lastName;
        $nombre_completo = $nombre . ' ' . $apell_paterno . ' ' . $apell_materno;
        $cuenta2 = Cuenta::create([
            'CUE_EMAIL' => 'tra@foo.com',
            'CUE_PASSWORD' => Hash::make('td12345'),
            'CUE_NOMBRES' => $nombre,
            'CUE_APELL_PATERNO' => $apell_paterno,
            'CUE_APELL_MATERNO' => $apell_materno,
            'CUE_NOMBRE_COMPLETO' => $nombre_completo,
            'CUE_TELEFONO' => $faker->phoneNumber,
            'CUE_RUT' => '22.222.222-2',
            'CUE_TIPO' => 'transportista',
        ]);

        Transportista::create([
            'CUE_ID' => $cuenta2->CUE_ID,
            'TRA_VALORACION' => 0,
        ]);

        $nombre = $faker->firstName;
        $apell_paterno = $faker->lastName;
        $apell_materno = $faker->lastName;
        $nombre_completo = $nombre . ' ' . $apell_paterno . ' ' . $apell_materno;
        $cuenta3 = Cuenta::create([
            'CUE_EMAIL' => 'cli@foo.com',
            'CUE_PASSWORD' => Hash::make('td12345'),
            'CUE_NOMBRES' => $nombre,
            'CUE_APELL_PATERNO' => $apell_paterno,
            'CUE_APELL_MATERNO' => $apell_materno,
            'CUE_NOMBRE_COMPLETO' => $nombre_completo,
            'CUE_TELEFONO' => $faker->phoneNumber,
            'CUE_RUT' => '33.333.333-3',
            'CUE_TIPO' => 'cliente',
        ]);

        Cliente::create([
            'CUE_ID' => $cuenta3->CUE_ID,
            'EMP_ID' => null,
            'CLI_VALORACION' => 0,
        ]);
    }
}
