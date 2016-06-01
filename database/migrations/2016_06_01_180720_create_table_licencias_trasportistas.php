<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLicenciasTrasportistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TRANSPORTISTAS_LICENCIAS', function (Blueprint $table) {
            $table->integer('TRA_ID')->unsigned();
            $table->integer('LIC_ID')->unsigned();
            $table->date('TRA_LIC_FECHA_VENCIMIENTO');
            $table->foreign('TRA_ID')->references('TRA_ID')->on('TRANSPORTISTAS');
            $table->foreign('LIC_ID')->references('LIC_ID')->on('LICENCIAS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('TRANSPORTISTAS_LICENCIAS');
    }
}
