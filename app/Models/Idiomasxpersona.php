<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idiomasxpersona extends Model
{
    protected $table = 'idiomasxpersona';
    public $timestamps = false;
    protected $primaryKey = 'IDI_CODIGO';

    public function getIdAttribute()
    {
        return $this->IDI_CODIGO;
    }


    public function Persona()
    {
        return $this->belongsTo('App\Models\Persona', 'PE_CODIGO');
    }
}
