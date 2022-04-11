<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{

    protected $table = 'persona';
    public $timestamps = false;
    protected $primaryKey = 'PE_CODIGO';

    public function getIdAttribute()
    {
        return $this->PE_CODIGO;
    }

    public function getFullNameAttribute()
    {
        return "$this->PE_NOMBRES $this->PE_APELLIDO_P $this->PE_APELLIDO_M";
    }


    public function user()
    {
        return $this->belongsTo('App\User', 'US_CODIGO');
    }



    public function getFechaNacimiento()
    {
        $fec_naci = date_create($this->PE_FECHA_NAC);
        return date_format($fec_naci, 'd/m/Y');
    }

    public function getDiaMesNacimiento()
    {
        $fec_naci = date_create($this->PE_FECHA_NAC);
        $dia_nacif = date_format($fec_naci, 'd'); //dia del 1 al 31
        $mes_nacif = date_format($fec_naci, 'n'); // Mes del 1 al 12


        $array_mes_espa = array(
            1 => "Enero",
            2 => "Febrero",
            3 => "Marzo",
            4 => "Abril",
            5 => "Mayo",
            6 => "Junio",
            7 => "Julio",
            8 => "Agosto",
            9 => "Septiembre",
            10 => "Octubre",
            11 => "Noviembre",
            12 => "Diciembre"
        );

        $mes_espa = $array_mes_espa[$mes_nacif];
        $diaymes_espa = $dia_nacif . " de " . $mes_espa;
        return $diaymes_espa;
    }

    public function getEdadAttribute()
    {

        $edad = 0;
        if (!empty($this->PE_FECHA_NAC)) {
            $fecha_nacimiento = $this->PE_FECHA_NAC;
            $dia_actual = date("Y-m-d");
            $edad = date_diff(date_create($fecha_nacimiento), date_create($dia_actual))->format('%y');
        } else {
            $edad = '-';
        }

        return $edad;
    }
    public function getEdadFormatAttribute()
    {

        $edad = 0;
        if (!empty($this->PE_FECHA_NAC)) {
            $fecha_nacimiento = $this->PE_FECHA_NAC;
            $dia_actual = date("Y-m-d");
            $edad = date_diff(date_create($fecha_nacimiento), date_create($dia_actual))->format('%y') . ' años';
        } else {
            $edad = '-';
        }

        return $edad;
    }

    //AWS S3
    public function getFotoAttribute()
    {
        if (!empty($this->PE_URL_FOTO)) {
            return url("bucket/swacv-fotos/" . $this->PE_URL_FOTO);
        } else {
            return "";
        }
    }
}
