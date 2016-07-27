<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpActualizaTra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
       CREATE PROCEDURE SP_RECALCULAR_VALORACION_DEL_TRANSPORTISTA
		
		@TRA_ID int
        AS
        BEGIN
	        SET NOCOUNT ON;

	        declare @numero_de_envios_validos float;
	        declare @suma_de_valoraciones float;

	        select @numero_de_envios_validos = count(*), @suma_de_valoraciones= sum(ENV_VALORACION_TRA)
	        from ENVIOS
	        where TRA_ID = @TRA_ID AND ENV_VALORACION_TRA != 0 AND ENV_ESTADO = \'Finalizado\';
	        --print @suma_de_valoraciones;
	        --print @numero_de_envios_validos;
	        IF (@suma_de_valoraciones IS NULL)
		        BEGIN
			        update TRANSPORTISTAS set TRA_VALORACION = 0 where TRA_ID = @TRA_ID
		        END
	        ELSE
		        BEGIN
			        update TRANSPORTISTAS set TRA_VALORACION = ROUND(@suma_de_valoraciones/@numero_de_envios_validos,1) where TRA_ID = @TRA_ID
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
        DB::unprepared('
        DROP PROCEDURE SP_RECALCULAR_VALORACION_DEL_TRANSPORTISTA
        ');
    }
}
