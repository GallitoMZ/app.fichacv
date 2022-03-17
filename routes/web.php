<?php

use App\Mail\TestMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuarios', 'UsuariosController@usuarios')->name('usuarios');
Route::get('/personas', 'UsuariosController@personas')->name('personas');

Route::group(["prefix" => "user", "middleware" => ['auth']], function () {

    //Datos Generales
    Route::get('/formulario/datos_generales', 'PerfilCurricular\DatosGeneralesController@datos_generales')->name('formulario.datos_generales');
    Route::post('/formulario/datos_generales/guardar', 'PerfilCurricular\DatosGeneralesController@guardar')->name('formulario.datos_generales.guardar');
    Route::get('/formulario/prueba', 'PerfilCurricular\DatosGeneralesController@prueba')->name('formulario.datos_generales.prueba');
});
// Route::get('/contacto',function(){
//     $correo = new TestMail;
//     Mail::to('erik.melgarejo5@gmail.com')->send($correo);
//     return "Mensaje enviado";
// });

Route::any('bucket/{location}/{filename}', function ($location, $filename) {
    $file = Storage::disk('s3')->get($location . '/' . $filename);
    if (strpos($filename, 'pdf') || strpos($filename, 'PDF')) {
        $headers = [
            'Content-Description' => 'File Transfer',
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename={$filename}",
            'filename' => $filename
        ];
    } else {
        $headers = [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$filename}",
            'filename' => $filename
        ];
    }
    return (new \Illuminate\Http\Response($file, 200, $headers));
});
