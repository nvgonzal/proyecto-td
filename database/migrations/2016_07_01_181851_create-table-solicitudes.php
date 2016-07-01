<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solucitudes', function (Blueprint $table) {
            $table->integer('TRA_ID')->unsigned();
            $table->integer('ENV_ID')->unsigned();
            $table->foreign('TRA_ID')->references('TRA_ID')->on('TRANSPORTISTAS');
            $table->foreign('ENV_ID')->references('ENV_ID')->on('ENVIOS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solucitudes');
    }
}
