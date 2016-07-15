<?php

use Illuminate\Database\Seeder;
use App\Envio;

class EnviosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        for ($i = 0; $i < 2000; $i++) {
            Envio::create([
                'CLI_ID' => 1,
                'ENV_DIRECCION_RECOGIDA' => $faker->address,
                'ENV_DIRECCION_DESTINO' => $faker->address,
                'ENV_FECHA_LIMITE' => $faker->dateTimeBetween('now', '2 years'),
                'ENV_TIPO' => $faker->sentence(3),
                'ENV_PESO_CARGA' => $faker->randomFloat(2, 0.1),
                'ENV_DESCRIPCION' => $faker->text(120),
                'ENV_VOLUMEN' => $faker->randomFloat(2, 0.1),
                'ENV_TIPO_CAMION' => $faker->sentence(3),
                'ENV_VALORACION_CLI' => 0,
                'ENV_VALORACION_TRA' => 0,
                'ENV_COORDENADAS_RECOGIDA' => $faker->latitude . ',' . $faker->longitude,
                'ENV_COORDENADAS_DESTINO' => $faker->latitude . ',' . $faker->longitude,
                'ENV_ESTADO' => $faker->randomElement(['Activo', 'Finalizado']),
            ]);
        }
    }
}
