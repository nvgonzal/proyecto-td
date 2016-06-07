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
}
