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

    public function solicitudes()
    {
        return $this->belongsToMany('App\Transportista', 'dbo.solicitudes', 'ENV_ID', 'TRA_ID');
    }

    public function scopeActivo($query)
    {
        return $query->where('ENV_ESTADO', 'Activo');
    }

    public function scopeAsigando($query)
    {
        return $query->where('ENV_ESTADO', 'Asignado');
    }

    public function scopeFinalizado($query)
    {
        return $query->where('ENV_ESTADO', 'Finalizado');
    }
}
