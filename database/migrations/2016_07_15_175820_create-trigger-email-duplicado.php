<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerEmailDuplicado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER CUENTAS_EMAIL_DUPLICADO
        ON CUENTAS
        FOR INSERT, UPDATE
        AS
        BEGIN
            declare @cuenta integer; 
	        SET NOCOUNT ON
            select @cuenta = count(*)
	        from CUENTAS e, inserted
	        where inserted.CUE_EMAIL = e.CUE_EMAIL and inserted.CUE_ID != e.CUE_ID
	        if @cuenta > 0
	        BEGIN
	            raiserror (\'Error el email esta repetido\',10,1)
	            rollback transaction;
	        END
	    END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
        DROP TRIGGER CUENTAS_EMAIL_DUPLICADO
        ');
    }
}
