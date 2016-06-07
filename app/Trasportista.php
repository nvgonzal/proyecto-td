<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trasportista extends Model
{
    protected $table = 'dbo.TRANSPORTISTAS';
    public $timestamps = false;
    protected $primaryKey = 'TRA_ID';

    public function cuenta()
    {
        return $this->belongsTo('App\Cuenta', 'CUE_ID', 'CUE_ID');
    }

    public function licencias()
    {
        return $this->belongsToMany('App\Licencia', 'dbo.TRASPORTISTAS_CLIENTES', 'TRA_ID', 'LIC_ID');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\Vehiculo', 'VEH_ID');
    }

    public function envios()
    {
        return $this->hasMany('App\Envio', 'TRA_ID');
    }
}
