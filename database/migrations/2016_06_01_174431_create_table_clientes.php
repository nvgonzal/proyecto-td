<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CLIENTES', function (Blueprint $table) {
            $table->increments('CLI_ID');
            $table->integer('CUE_ID')->unsigned();
            $table->integer('EMP_ID')->unsigned()->nullable();
            $table->float('CLI_VALORACION');
            $table->foreign('CUE_ID')->references('CUE_ID')->on('CUENTAS')->onDelete('cascade');
            $table->foreign('EMP_ID')->references('EMP_ID')->on('EMPRESAS')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CLIENTES');
    }
}
