<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrasportistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TRANSPORTISTAS', function (Blueprint $table) {
            $table->increments('TRA_ID');
            $table->integer('CUE_ID')->unsigned();
            $table->float('TRA_VALORACION');
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
        Schema::drop('TRANSPORTISTAS');
    }
}
