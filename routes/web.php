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

    //estudios
    Route::get('/formulario/estudios', 'PerfilCurricular\DatosGeneralesController@prueba')->name('formulario.datos_generales.prueba');

    Route::get('/formulario/educacion', 'PerfilCurricular\DatosGeneralesController@educacion')->name('formulario.educacion');
    Route::post('/formulario/educacion/agregar_estudios', 'PerfilCurricular\DatosGeneralesController@agregar_estudios')->name('formulario.educacion.agregar_estudios');
    Route::get('/formulario/educacion/get_estudios/{id}', 'PerfilCurricular\DatosGeneralesController@get_estudios')->name('formulario.educacion.get_estudios');
    Route::post('/formulario/educacion/editar_estudios', 'PerfilCurricular\DatosGeneralesController@editar_estudios')->name('formulario.educacion.editar_estudios');
    Route::post('/formulario/educacion/eliminar_estudios', 'PerfilCurricular\DatosGeneralesController@eliminar_estudios')->name('formulario.educacion.eliminar_estudios');

    Route::post('/formulario/educacion/agregar_idioma', 'PerfilCurricular\DatosGeneralesController@agregar_idioma')->name('formulario.educacion.agregar_idioma');
    Route::post('/formulario/educacion/eliminar_idioma', 'PerfilCurricular\DatosGeneralesController@eliminar_idioma')->name('formulario.educacion.eliminar_idioma');

    Route::post('/formulario/educacion/agregar_interes', 'PerfilCurricular\DatosGeneralesController@agregar_interes')->name('formulario.educacion.agregar_interes');
    Route::post('/formulario/educacion/eliminar_interes', 'PerfilCurricular\DatosGeneralesController@eliminar_interes')->name('formulario.educacion.eliminar_interes');

    Route::get('/formulario/prueba', 'PerfilCurricular\DatosGeneralesController@prueba')->name('formulario.datos_generales.prueba');
    Route::get('/formulario/descargar_ficha/view/{id}', 'PerfilCurricular\DatosGeneralesController@ver_ficha')->name('formulario.datos_generales.ver_ficha');
    Route::get('/formulario/descargar_ficha/download/{id}', 'PerfilCurricular\DatosGeneralesController@descargar_ficha')->name('formulario.datos_generales.descargar_ficha');


    // DINAMICAS
    Route::get('/formulario/dinamica', 'PerfilCurricular\DatosGeneralesController@dinamica')->name('formulario.dinamica');
    Route::post('/formulario/dinamica/guardar', 'PerfilCurricular\DatosGeneralesController@dinamica_guardar')->name('formulario.dinamica_guardar');
});

Route::get('prueba', function () {
    return "<h1>Has accedido correctamente a la ruta</h1>";
})->middleware('age');

Route::get('no-autorized', function () {
    return "<h1>NO AUTORIZADO</h1>";
});


//BUCKET S3 AWS
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
