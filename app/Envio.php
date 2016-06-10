<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $table = 'dbo.ENVIOS';
    protected $primaryKey = 'ENV_ID';

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'CLI_ID');
    }

    public function transportista()
    {
        return $this->belongsTo('App\Transportista', 'TRA_ID');
    }
}
