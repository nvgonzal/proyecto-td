<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'dbo.CLIENTES';
    public $timestamps = false;
    protected $primaryKey = 'CLI_ID';

    public function cuenta()
    {
        return $this->belongsTo('App\Cuenta', 'CUE_ID', 'CUE_ID');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresas', 'CLI_ID');
    }

    public function envios()
    {
        return $this->hasMany('App\Envio', 'CLI_ID');
    }

}
