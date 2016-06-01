<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VEHICULOS', function (Blueprint $table) {
            $table->increments('VEH_ID');
            $table->integer('TRA_ID')->unsigned();
            $table->string('VEH_MODELO',100);
            $table->string('VEH_PATENTE',15);
            $table->string('VEH_MARCA',50);
            $table->float('VEH_CAPACIDAD');
            $table->text('VEH_DESCRIPCION');
            $table->integer('VEH_ANIO');
            $table->foreign('TRA_ID')->references('TRA_ID')->on('TRANSPORTISTAS')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('VEHICULOS');
    }
}
