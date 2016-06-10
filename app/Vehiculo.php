<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'dbo.VEHICULOS';
    protected $primaryKey = 'VEH_ID';

    public $timestamps = false;

    public function trasportista()
    {
        return $this->belongsTo('App\Trasportisa', 'TRA_ID');
    }
}
