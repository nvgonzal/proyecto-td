<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerRutDuplicado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            '
            CREATE TRIGGER CUENTAS_RUT_DUPLICADO
            ON CUENTAS
            FOR INSERT, UPDATE
            AS
            BEGIN
                declare @cuenta integer; 
	            SET NOCOUNT ON
                select @cuenta = count(*)
	            from CUENTAS e, inserted
	            where inserted.CUE_RUT = e.CUE_RUT and inserted.CUE_ID != e.CUE_ID
	            if @cuenta > 0
	            BEGIN
	                raiserror (\'Error el rut esta repetido\',10,1)
	                rollback transaction;
	            END
	        END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(
            'DROP TRIGGER CUENTAS_RUT_DUPLICADO
        ');
    }
}
