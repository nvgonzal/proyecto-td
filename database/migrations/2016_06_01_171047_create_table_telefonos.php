<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTelefonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TELEFONOS', function (Blueprint $table) {
            $table->increments('TEL_ID');
            $table->string('TEL_NUMERO',100);
            $table->integer('CUE_ID')->unsigned();
            $table->foreign('CUE_ID')->references('CUE_ID')->on('CUENTAS')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TELEFONOS');
    }
}
