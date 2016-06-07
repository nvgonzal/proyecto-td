<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'dbo.EMPRESAS';
    protected $primaryKey = 'EMP_ID';
    public $timestamps = false;

    public function clientes()
    {
        return $this->hasMany('App\Cliente', 'CUE_ID');
    }
}
