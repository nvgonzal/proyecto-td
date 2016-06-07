<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    protected $table = 'dbo.LICENCIAS';
    protected $primaryKey = 'LIC_ID';

    public $timestamps = false;

    public function trasportistas()
    {
        return $this->belongsToMany('App\Trasportistas', 'dbo.TRASPORTISTAS_CLIENTES', 'LIC_ID', 'TRA_ID');
    }
}
