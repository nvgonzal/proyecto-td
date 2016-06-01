<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EMPRESAS', function (Blueprint $table) {
            $table->increments('EMP_ID');
            $table->string('EMP_NOMBRE',60);
            $table->string('EMP_DIRECCION');
            $table->string('EMP_TELEFONO',100);
            $table->string('EMP_LINK_LOGO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('EMPRESAS');
    }
}
