<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cuenta extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $table = 'dbo.CUENTAS';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}
