<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiosxpersona extends Model
{
    protected $table = 'estudiosxpersona';
    public $timestamps = false;
    protected $primaryKey = 'EST_CODIGO';

    public function getIdAttribute()
    {
        return $this->EST_CODIGO;
    }


    public function Persona()
    {
        return $this->belongsTo('App\Models\Persona', 'PE_CODIGO');
    }
}
