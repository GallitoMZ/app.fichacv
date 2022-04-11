<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interesesxpersona extends Model
{
    protected $table = 'interesesxpersona';
    public $timestamps = false;
    protected $primaryKey = 'INTE_CODIGO';

    public function getIdAttribute()
    {
        return $this->INTE_CODIGO;
    }


    public function Persona()
    {
        return $this->belongsTo('App\Models\Persona', 'PE_CODIGO');
    }
}
