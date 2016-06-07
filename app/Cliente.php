<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'dbo.CLIENTES';
    public $timestamps = false;
    protected $primaryKey = 'CLI_ID';


}
