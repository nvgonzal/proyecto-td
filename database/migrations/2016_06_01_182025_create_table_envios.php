<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEnvios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ENVIOS', function (Blueprint $table) {
            $table->increments('ENV_ID');
            $table->integer('CLI_ID')->unsigned()->nullable();
            $table->integer('TRA_ID')->unsigned()->nullable();
            $table->string('ENV_DIRECCION_RECOGIDA');
            $table->string('ENV_DIRECCION_DESTINO');
            $table->date('ENV_FECHA_LIMITE');
            $table->string('ENV_TIPO',100);
            $table->float('ENV_PESO_CARGA');
            $table->text('ENV_DESCRIPCION');
            $table->float('ENV_VOLUMEN');
            $table->string('ENV_TIPO_CAMION',50);
            $table->integer('ENV_VALORACION_CLI');
            $table->integer('ENV_VALORACION_TRA');
            $table->string('ENV_COORDENADAS_RECOGIDA',150);
            $table->string('ENV_COORDENADAS_DESTINO',150);
            $table->string('ENV_ESTADO')->default('Activo');
            $table->foreign('CLI_ID')->references('CLI_ID')->on('CLIENTES');
            $table->foreign('TRA_ID')->references('TRA_ID')->on('TRANSPORTISTAS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ENVIOS');
    }
}
