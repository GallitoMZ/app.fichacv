<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\User;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function usuarios()
    {
        $users  = User::all();

        // return json_decode($users->persona);
        return response()->json($users->persona);

    }

    public function personas()
    {
        $personas  = Persona::get();
        // $pers = Persona::with('user')->get();
        $pers = Persona::where('PE_NUM_DOCU', '12345678')->first();
        // $pers = Persona::find(1);
        $usuario = $pers->user->email;
        $data['persona']=$pers;
        $data['usuario']=$usuario;


        return response()->json($data);
    }


}
