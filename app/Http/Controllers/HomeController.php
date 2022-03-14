<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $persona = Persona::where('US_CODIGO', $user->id)->first();
        if ($persona) {
            $data['persona'] = $persona;
        } else {
            $persona_new = new Persona();
            $persona_new->PE_NOMBRES=$user->name;
            $persona_new->PE_CORREO=$user->email;
            $persona_new->US_CODIGO=$user->id;
            $persona_new->save();
            $data['persona'] = $persona_new;
        }
        $data['user'] = $user;
        return view('home', compact('data'));
    }
}
