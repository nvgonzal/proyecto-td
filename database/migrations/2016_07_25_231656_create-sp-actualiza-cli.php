<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpActualizaCli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE PROCEDURE SP_RECALCULAR_VALORACION_DEL_CLIENTE
	
		@CLI_ID int
        AS
        BEGIN
	
	    SET NOCOUNT ON;

	    declare @numero_de_envios_validos float;
	    declare @suma_de_valoraciones float;

	    select @numero_de_envios_validos= count(*),@suma_de_valoraciones = sum(ENV_VALORACION_CLI)
	    from ENVIOS
	    where CLI_ID = @CLI_ID AND ENV_VALORACION_CLI != 0 AND ENV_ESTADO =\'Finalizado\';
	    IF (@suma_de_valoraciones IS NULL)
		    BEGIN
			    update CLIENTES set CLI_VALORACION = 0 where CLI_ID = @CLI_ID
		    END
	    ELSE
		    BEGIN
			    update CLIENTES set CLI_VALORACION = ROUND(@suma_de_valoraciones/@numero_de_envios_validos,1) where CLI_ID = @CLI_ID
		    END
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE SP_RECALCULAR_VALORACION_DEL_CLIENTE');
    }
}
