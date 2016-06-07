<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CUENTAS', function (Blueprint $table) {
            $table->increments('CUE_ID');
            $table->string('CUE_EMAIL')->unique();
            $table->string('CUE_PASSWORD');
            $table->string('CUE_RUT',12);
            $table->string('CUE_NOMBRES',60);
            $table->string('CUE_APELL_PATERNO',60);
            $table->string('CUE_APELL_MATERNO',60);
            $table->string('CUE_TIPO',15);
            $table->string('CUE_TELEFONO', 40);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CUENTAS');
    }
}
