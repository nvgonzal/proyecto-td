<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trasportista extends Model
{
    protected $table = 'dbo.CLIENTES';
    public $timestamps = false;
    protected $primaryKey = 'CLI_ID';
}