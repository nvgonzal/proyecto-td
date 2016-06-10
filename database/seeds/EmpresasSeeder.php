<?php

use Illuminate\Database\Seeder;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logos = [
            'http://s3.amazonaws.com/logospire/4729/original/4729.png',
            'http://s3.amazonaws.com/logospire/4811/original/4811.jpg',
            'http://s3.amazonaws.com/logospire/4483/original/4483.png',
            'http://s3.amazonaws.com/logospire/4699/original/4699.png',
            'http://s3.amazonaws.com/logospire/4482/original/4482.png',
            'http://s3.amazonaws.com/logospire/3254/original/3254.jpg',
            'http://s3.amazonaws.com/logospire/1850/original/1850.png',
            'http://s3.amazonaws.com/logospire/2019/original/2019.jpg',
            'http://s3.amazonaws.com/logospire/2212/original/2212.jpg',
            'http://s3.amazonaws.com/logospire/4484/original/4484.png',
            'http://s3.amazonaws.com/logospire/1535/original/1535.png',
            'http://s3.amazonaws.com/logospire/5139/original/5139.jpg',
            'http://s3.amazonaws.com/logospire/5729/original/5729.jpg',
            'http://s3.amazonaws.com/logospire/4044/original/4044.png',
            'http://s3.amazonaws.com/logospire/292/original/292.jpg',
        ];


        $faker = Faker\Factory::create('es_ES');

        for ($i = 1; $i <= 15; $i++) {
            DB::table('dbo.EMPRESAS')->insert([
                'EMP_NOMBRE' => $faker->company,
                'EMP_DIRECCION' => $faker->address,
                'EMP_TELEFONO' => $faker->phoneNumber,
                'EMP_LINK_LOGO' => $logos[$i],
            ]);
        }
    }
}
