<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'dbo.TRASPORTISTAS';
    public $timestamps = false;
    protected $primaryKey = 'TRA_ID';


}
