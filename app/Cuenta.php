<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cuenta extends Authenticatable
{

    protected $table = 'dbo.CUENTAS';

    protected $hidden = [
        'CUE_PASSWORD', 'remember_token',
    ];

    public $timestamps = false;

    public $primaryKey = 'CUE_ID';

    public function getAuthPassword()
    {
        return $this->CUE_PASSWORD;
    }
}
