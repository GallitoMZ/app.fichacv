<?php

namespace App\Http\Controllers\PerfilCurricular;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Util\CommonController;
use App\Models\data_req_s1;
use App\Models\data_req_s2;

use App\Models\Estudiosxpersona;
use App\Models\Idiomasxpersona;
use App\Models\Interesesxpersona;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DatosGeneralesController extends Controller
{

    public function datos_generales(Request $request)
    {

        $user = auth()->user();
        $persona = Persona::where('US_CODIGO', $user->id)->first();
        if ($persona) {
            $data['persona'] = $persona;
        } else {
            $persona_new = new Persona();
            $persona_new->PE_NOMBRES = $user->name;
            $persona_new->PE_CORREO = $user->email;
            $persona_new->US_CODIGO = $user->id;
            $persona_new->save();
            $data['persona'] = $persona_new;
        }
        $data['user'] = $user;



        $paises = [
            "Perú" => "Perú",
            "Afganistán" => "Afganistán",
            "Albania" => "Albania",
            "Alemania" => "Alemania",
            "Andorra" => "Andorra",
            "Angola" => "Angola",
            "Antigua y Barbuda" => "Antigua y Barbuda",
            "Arabia Saudita" => "Arabia Saudita",
            "Argelia" => "Argelia",
            "Argentina" => "Argentina",
            "Armenia" => "Armenia",
            "Australia" => "Australia",
            "Austria" => "Austria",
            "Azerbaiyán" => "Azerbaiyán",
            "Bahamas" => "Bahamas",
            "Bangladés" => "Bangladés",
            "Barbados" => "Barbados",
            "Baréin" => "Baréin",
            "Bélgica" => "Bélgica",
            "Belice" => "Belice",
            "Benín" => "Benín",
            "Bielorrusia" => "Bielorrusia",
            "Birmania" => "Birmania",
            "Bolivia" => "Bolivia",
            "Bosnia y Herzegovina" => "Bosnia y Herzegovina",
            "Botsuana" => "Botsuana",
            "Brasil" => "Brasil",
            "Brunéi" => "Brunéi",
            "Bulgaria" => "Bulgaria",
            "Burkina Faso" => "Burkina Faso",
            "Burundi" => "Burundi",
            "Bután" => "Bután",
            "Cabo Verde" => "Cabo Verde",
            "Camboya" => "Camboya",
            "Camerún" => "Camerún",
            "Canadá" => "Canadá",
            "Catar" => "Catar",
            "Chad" => "Chad",
            "Chile" => "Chile",
            "China" => "China",
            "Chipre" => "Chipre",
            "Ciudad del Vaticano" => "Ciudad del Vaticano",
            "Colombia" => "Colombia",
            "Comoras" => "Comoras",
            "Corea del Norte" => "Corea del Norte",
            "Corea del Sur" => "Corea del Sur",
            "Costa de Marfil" => "Costa de Marfil",
            "Costa Rica" => "Costa Rica",
            "Croacia" => "Croacia",
            "Cuba" => "Cuba",
            "Dinamarca" => "Dinamarca",
            "Dominica" => "Dominica",
            "Ecuador" => "Ecuador",
            "Egipto" => "Egipto",
            "El Salvador" => "El Salvador",
            "Emiratos Árabes Unidos" => "Emiratos Árabes Unidos",
            "Eritrea" => "Eritrea",
            "Eslovaquia" => "Eslovaquia",
            "Eslovenia" => "Eslovenia",
            "España" => "España",
            "Estados Unidos" => "Estados Unidos",
            "Estonia" => "Estonia",
            "Etiopía" => "Etiopía",
            "Filipinas" => "Filipinas",
            "Finlandia" => "Finlandia",
            "Fiyi" => "Fiyi",
            "Francia" => "Francia",
            "Gabón" => "Gabón",
            "Gambia" => "Gambia",
            "Georgia" => "Georgia",
            "Ghana" => "Ghana",
            "Granada" => "Granada",
            "Grecia" => "Grecia",
            "Guatemala" => "Guatemala",
            "Guyana" => "Guyana",
            "Guinea" => "Guinea",
            "Guinea ecuatorial" => "Guinea ecuatorial",
            "Guinea-Bisáu" => "Guinea-Bisáu",
            "Haití" => "Haití",
            "Honduras" => "Honduras",
            "Hungría" => "Hungría",
            "India" => "India",
            "Indonesia" => "Indonesia",
            "Irak" => "Irak",
            "Irán" => "Irán",
            "Irlanda" => "Irlanda",
            "Islandia" => "Islandia",
            "Islas Marshall" => "Islas Marshall",
            "Islas Salomón" => "Islas Salomón",
            "Israel" => "Israel",
            "Italia" => "Italia",
            "Jamaica" => "Jamaica",
            "Japón" => "Japón",
            "Jordania" => "Jordania",
            "Kazajistán" => "Kazajistán",
            "Kenia" => "Kenia",
            "Kirguistán" => "Kirguistán",
            "Kiribati" => "Kiribati",
            "Kuwait" => "Kuwait",
            "Laos" => "Laos",
            "Lesoto" => "Lesoto",
            "Letonia" => "Letonia",
            "Líbano" => "Líbano",
            "Liberia" => "Liberia",
            "Libia" => "Libia",
            "Liechtenstein" => "Liechtenstein",
            "Lituania" => "Lituania",
            "Luxemburgo" => "Luxemburgo",
            "Macedonia del Norte" => "Macedonia del Norte",
            "Madagascar" => "Madagascar",
            "Malasia" => "Malasia",
            "Malaui" => "Malaui",
            "Maldivas" => "Maldivas",
            "Malí" => "Malí",
            "Malta" => "Malta",
            "Marruecos" => "Marruecos",
            "Mauricio" => "Mauricio",
            "Mauritania" => "Mauritania",
            "México" => "México",
            "Micronesia" => "Micronesia",
            "Moldavia" => "Moldavia",
            "Mónaco" => "Mónaco",
            "Mongolia" => "Mongolia",
            "Montenegro" => "Montenegro",
            "Mozambique" => "Mozambique",
            "Namibia" => "Namibia",
            "Nauru" => "Nauru",
            "Nepal" => "Nepal",
            "Nicaragua" => "Nicaragua",
            "Níger" => "Níger",
            "Nigeria" => "Nigeria",
            "Noruega" => "Noruega",
            "Nueva Zelanda" => "Nueva Zelanda",
            "Omán" => "Omán",
            "Países Bajos" => "Países Bajos",
            "Pakistán" => "Pakistán",
            "Palaos" => "Palaos",
            "Panamá" => "Panamá",
            "Papúa Nueva Guinea" => "Papúa Nueva Guinea",
            "Paraguay" => "Paraguay",
            "Polonia" => "Polonia",
            "Portugal" => "Portugal",
            "Reino Unido" => "Reino Unido",
            "República Centroafricana" => "República Centroafricana",
            "República Checa" => "República Checa",
            "República del Congo" => "República del Congo",
            "República Democrática del Congo" => "República Democrática del Congo",
            "República Dominicana" => "República Dominicana",
            "Ruanda" => "Ruanda",
            "Rumanía" => "Rumanía",
            "Rusia" => "Rusia",
            "Samoa" => "Samoa",
            "San Cristóbal y Nieves" => "San Cristóbal y Nieves",
            "San Marino" => "San Marino",
            "San Vicente y las Granadinas" => "San Vicente y las Granadinas",
            "Santa Lucía" => "Santa Lucía",
            "Santo Tomé y Príncipe" => "Santo Tomé y Príncipe",
            "Senegal" => "Senegal",
            "Serbia" => "Serbia",
            "Seychelles" => "Seychelles",
            "Sierra Leona" => "Sierra Leona",
            "Singapur" => "Singapur",
            "Siria" => "Siria",
            "Somalia" => "Somalia",
            "Sri Lanka" => "Sri Lanka",
            "Suazilandia" => "Suazilandia",
            "Sudáfrica" => "Sudáfrica",
            "Sudán" => "Sudán",
            "Sudán del Sur" => "Sudán del Sur",
            "Suecia" => "Suecia",
            "Suiza" => "Suiza",
            "Surinam" => "Surinam",
            "Tailandia" => "Tailandia",
            "Tanzania" => "Tanzania",
            "Tayikistán" => "Tayikistán",
            "Timor Oriental" => "Timor Oriental",
            "Togo" => "Togo",
            "Tonga" => "Tonga",
            "Trinidad y Tobago" => "Trinidad y Tobago",
            "Túnez" => "Túnez",
            "Turkmenistán" => "Turkmenistán",
            "Turquía" => "Turquía",
            "Tuvalu" => "Tuvalu",
            "Ucrania" => "Ucrania",
            "Uganda" => "Uganda",
            "Uruguay" => "Uruguay",
            "Uzbekistán" => "Uzbekistán",
            "Vanuatu" => "Vanuatu",
            "Venezuela" => "Venezuela",
            "Vietnam" => "Vietnam",
            "Yemen" => "Yemen",
            "Yibuti" => "Yibuti",
            "Zambia" => "Zambia",
            "Zimbabue" => "Zimbabue",
        ];
        $paises_eleccion = [
            '' => '[Seleccione País]',
            "Afganistán" => "Afganistán",
            "Albania" => "Albania",
            "Alemania" => "Alemania",
            "Andorra" => "Andorra",
            "Angola" => "Angola",
            "Antigua y Barbuda" => "Antigua y Barbuda",
            "Arabia Saudita" => "Arabia Saudita",
            "Argelia" => "Argelia",
            "Argentina" => "Argentina",
            "Armenia" => "Armenia",
            "Australia" => "Australia",
            "Austria" => "Austria",
            "Azerbaiyán" => "Azerbaiyán",
            "Bahamas" => "Bahamas",
            "Bangladés" => "Bangladés",
            "Barbados" => "Barbados",
            "Baréin" => "Baréin",
            "Bélgica" => "Bélgica",
            "Belice" => "Belice",
            "Benín" => "Benín",
            "Bielorrusia" => "Bielorrusia",
            "Birmania" => "Birmania",
            "Bolivia" => "Bolivia",
            "Bosnia y Herzegovina" => "Bosnia y Herzegovina",
            "Botsuana" => "Botsuana",
            "Brasil" => "Brasil",
            "Brunéi" => "Brunéi",
            "Bulgaria" => "Bulgaria",
            "Burkina Faso" => "Burkina Faso",
            "Burundi" => "Burundi",
            "Bután" => "Bután",
            "Cabo Verde" => "Cabo Verde",
            "Camboya" => "Camboya",
            "Camerún" => "Camerún",
            "Canadá" => "Canadá",
            "Catar" => "Catar",
            "Chad" => "Chad",
            "Chile" => "Chile",
            "China" => "China",
            "Chipre" => "Chipre",
            "Ciudad del Vaticano" => "Ciudad del Vaticano",
            "Colombia" => "Colombia",
            "Comoras" => "Comoras",
            "Corea del Norte" => "Corea del Norte",
            "Corea del Sur" => "Corea del Sur",
            "Costa de Marfil" => "Costa de Marfil",
            "Costa Rica" => "Costa Rica",
            "Croacia" => "Croacia",
            "Cuba" => "Cuba",
            "Dinamarca" => "Dinamarca",
            "Dominica" => "Dominica",
            "Ecuador" => "Ecuador",
            "Egipto" => "Egipto",
            "El Salvador" => "El Salvador",
            "Emiratos Árabes Unidos" => "Emiratos Árabes Unidos",
            "Eritrea" => "Eritrea",
            "Eslovaquia" => "Eslovaquia",
            "Eslovenia" => "Eslovenia",
            "España" => "España",
            "Estados Unidos" => "Estados Unidos",
            "Estonia" => "Estonia",
            "Etiopía" => "Etiopía",
            "Filipinas" => "Filipinas",
            "Finlandia" => "Finlandia",
            "Fiyi" => "Fiyi",
            "Francia" => "Francia",
            "Gabón" => "Gabón",
            "Gambia" => "Gambia",
            "Georgia" => "Georgia",
            "Ghana" => "Ghana",
            "Granada" => "Granada",
            "Grecia" => "Grecia",
            "Guatemala" => "Guatemala",
            "Guyana" => "Guyana",
            "Guinea" => "Guinea",
            "Guinea ecuatorial" => "Guinea ecuatorial",
            "Guinea-Bisáu" => "Guinea-Bisáu",
            "Haití" => "Haití",
            "Honduras" => "Honduras",
            "Hungría" => "Hungría",
            "India" => "India",
            "Indonesia" => "Indonesia",
            "Irak" => "Irak",
            "Irán" => "Irán",
            "Irlanda" => "Irlanda",
            "Islandia" => "Islandia",
            "Islas Marshall" => "Islas Marshall",
            "Islas Salomón" => "Islas Salomón",
            "Israel" => "Israel",
            "Italia" => "Italia",
            "Jamaica" => "Jamaica",
            "Japón" => "Japón",
            "Jordania" => "Jordania",
            "Kazajistán" => "Kazajistán",
            "Kenia" => "Kenia",
            "Kirguistán" => "Kirguistán",
            "Kiribati" => "Kiribati",
            "Kuwait" => "Kuwait",
            "Laos" => "Laos",
            "Lesoto" => "Lesoto",
            "Letonia" => "Letonia",
            "Líbano" => "Líbano",
            "Liberia" => "Liberia",
            "Libia" => "Libia",
            "Liechtenstein" => "Liechtenstein",
            "Lituania" => "Lituania",
            "Luxemburgo" => "Luxemburgo",
            "Macedonia del Norte" => "Macedonia del Norte",
            "Madagascar" => "Madagascar",
            "Malasia" => "Malasia",
            "Malaui" => "Malaui",
            "Maldivas" => "Maldivas",
            "Malí" => "Malí",
            "Malta" => "Malta",
            "Marruecos" => "Marruecos",
            "Mauricio" => "Mauricio",
            "Mauritania" => "Mauritania",
            "México" => "México",
            "Micronesia" => "Micronesia",
            "Moldavia" => "Moldavia",
            "Mónaco" => "Mónaco",
            "Mongolia" => "Mongolia",
            "Montenegro" => "Montenegro",
            "Mozambique" => "Mozambique",
            "Namibia" => "Namibia",
            "Nauru" => "Nauru",
            "Nepal" => "Nepal",
            "Nicaragua" => "Nicaragua",
            "Níger" => "Níger",
            "Nigeria" => "Nigeria",
            "Noruega" => "Noruega",
            "Nueva Zelanda" => "Nueva Zelanda",
            "Omán" => "Omán",
            "Países Bajos" => "Países Bajos",
            "Pakistán" => "Pakistán",
            "Palaos" => "Palaos",
            "Panamá" => "Panamá",
            "Papúa Nueva Guinea" => "Papúa Nueva Guinea",
            "Paraguay" => "Paraguay",
            "Perú" => "Perú",
            "Polonia" => "Polonia",
            "Portugal" => "Portugal",
            "Reino Unido" => "Reino Unido",
            "República Centroafricana" => "República Centroafricana",
            "República Checa" => "República Checa",
            "República del Congo" => "República del Congo",
            "República Democrática del Congo" => "República Democrática del Congo",
            "República Dominicana" => "República Dominicana",
            "Ruanda" => "Ruanda",
            "Rumanía" => "Rumanía",
            "Rusia" => "Rusia",
            "Samoa" => "Samoa",
            "San Cristóbal y Nieves" => "San Cristóbal y Nieves",
            "San Marino" => "San Marino",
            "San Vicente y las Granadinas" => "San Vicente y las Granadinas",
            "Santa Lucía" => "Santa Lucía",
            "Santo Tomé y Príncipe" => "Santo Tomé y Príncipe",
            "Senegal" => "Senegal",
            "Serbia" => "Serbia",
            "Seychelles" => "Seychelles",
            "Sierra Leona" => "Sierra Leona",
            "Singapur" => "Singapur",
            "Siria" => "Siria",
            "Somalia" => "Somalia",
            "Sri Lanka" => "Sri Lanka",
            "Suazilandia" => "Suazilandia",
            "Sudáfrica" => "Sudáfrica",
            "Sudán" => "Sudán",
            "Sudán del Sur" => "Sudán del Sur",
            "Suecia" => "Suecia",
            "Suiza" => "Suiza",
            "Surinam" => "Surinam",
            "Tailandia" => "Tailandia",
            "Tanzania" => "Tanzania",
            "Tayikistán" => "Tayikistán",
            "Timor Oriental" => "Timor Oriental",
            "Togo" => "Togo",
            "Tonga" => "Tonga",
            "Trinidad y Tobago" => "Trinidad y Tobago",
            "Túnez" => "Túnez",
            "Turkmenistán" => "Turkmenistán",
            "Turquía" => "Turquía",
            "Tuvalu" => "Tuvalu",
            "Ucrania" => "Ucrania",
            "Uganda" => "Uganda",
            "Uruguay" => "Uruguay",
            "Uzbekistán" => "Uzbekistán",
            "Vanuatu" => "Vanuatu",
            "Venezuela" => "Venezuela",
            "Vietnam" => "Vietnam",
            "Yemen" => "Yemen",
            "Yibuti" => "Yibuti",
            "Zambia" => "Zambia",
            "Zimbabue" => "Zimbabue",
        ];

        $tiposdocumento = [
            '' => '[Tipo de Documento]',
            'DNI' => 'Documento de Identidad',
            'N° de identidad de extranjero' => 'N° de identidad de extranjero',
            'N° de identificación fiscal' => 'N° de identificación fiscal',
            'N° de pasaporte' => 'N° de pasaporte',
        ];

        $sexo = [
            '' => '[Sexo]',
            'MASCULINO' => 'MASCULINO',
            'FEMENINO' => 'FEMENINO'
        ];

        $tipozona = [
            '' => '[Tipo de Zona]',
            'URB. URBANIZACIÓN' => 'URB. URBANIZACIÓN',
            'P.J. PUEBLO JOVEN' => 'P.J. PUEBLO JOVEN',
            'U.V. UNIDAD VECINAL' => 'U.V. UNIDAD VECINAL',
            'C.H. CONJUNTO HABITACIONAL' => 'C.H. CONJUNTO HABITACIONAL',
            'A.H. ASENTAMIENTO HUMANO' => 'A.H. ASENTAMIENTO HUMANO',
            'COO. COOPERATIVA' => 'COO. COOPERATIVA',
            'RES. RESIDENCIAL' => 'RES. RESIDENCIAL',
            'Z.I. ZONA INDUSTRIAL' => 'Z.I. ZONA INDUSTRIAL',
            'GRU. GRUPO' => 'GRU. GRUPO',
            'CAS. CASERÍO' => 'CAS. CASERÍO',
            'FND. FUNDO' => 'FND. FUNDO'
        ];


        $estados_civiles = [
            '' => '[ ESTADO CIVIL ]',
            'CASADO' => 'CASADO',
            'SOLTERO' => 'SOLTERO',
            'CONVIVIENTE' => 'CONVIVIENTE',
            'VIUDO' => 'VIUDO',
            'DIVORCIADO' => 'DIVORCIADO',
            'S/ PREFERENCIA' => 'S/ PREFERENCIA'
        ];


        $data['paises_eleccion'] = $paises_eleccion;
        $data['estados_civiles'] = $estados_civiles;
        $data['sexo'] = $sexo;
        $data['tiposdocumento'] = $tiposdocumento;
        $data['paises'] = $paises;
        $data['tipozona'] = $tipozona;

        // $direccion = Direccionxpersona::where('PE_CODIGO', $persona->id)->first();

        return view('PerfilCurricular.datos_generales', compact('data'));
    }


    public function dinamica(Request $request)
    {

        $user = auth()->user();

        $data['user'] = $user;

        return view('PerfilCurricular.dinamica', compact('data'));
    }

    public function dinamica_guardar(Request $request)
    {

        DB::connection('mysql')->beginTransaction();
        DB::connection('mysql2')->beginTransaction();

        try {


            $info1 = data_req_s1::create([
                'DR_DATA' => $request->data_S1,
                'DR_ABREV' => $request->abrev_S1
            ]);

            $info2 = data_req_s2::create([
                'DR_DATA' => $request->data_S2,
                'DR_ABREV' => $request->abrev_S2
            ]);
            Log::info("HOLA");

            DB::connection('mysql')->commit();
            DB::connection('mysql2')->commit();

            $return = [
                'status' => 'ok',
                'titulo' => '¡Cambios Guardados!',
                'message' => 'Se guardó con éxito!'
            ];
            return response()->json($return);
        } catch (Exception $ex) {

            DB::connection('mysql')->rollBack();

            DB::connection('mysql2')->rollBack();
            $return = [
                'status' => 'error',
                'titulo' => '¡Error no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }

    public function guardar(Request $request)
    {
        try {

            if (empty($request->apellidopater)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Apellido Paterno'
                ];
                return $return;
            }

            if (empty($request->apellidomater)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Apellido Materno'
                ];
                return $return;
            }

            if (empty($request->nombre)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: Nombres'
                ];
                return $return;
            }



            $id = $request->persona_codigo;
            $persona = Persona::find($id);

            $persona->PE_NOMBRES = $request->nombre;
            $persona->PE_APELLIDO_P = $request->apellidopater;
            $persona->PE_APELLIDO_M = $request->apellidomater;

            $persona->PE_PAIS_NACION = $request->paisNacimiento;
            $persona->PE_CIUD_NACION = $request->ciudad;

            if (!empty($request->fec_naci)) {
                $fecha = date_format(date_create_from_format('d/m/Y', substr($request->fec_naci, 0, 10)), 'Y-m-d');
                $persona->PE_FECHA_NAC = $fecha;
            }
            $persona->PE_PAIS_DOCU = $request->paisDocumento;
            $persona->PE_TIPO_DOCU = $request->tipodocumento;
            $persona->PE_NUM_DOCU = $request->numdocumento;

            $persona->PE_SEXO = $request->sexo;
            $persona->PE_ESTADO_CIV = $request->estadocivil;

            $persona->PE_NUM_CEL = $request->celular;
            $persona->PE_LINKEDIN = $request->linkedin;
            $persona->PE_PERFIL = $request->perfil;

            //GUARDAR FOTO

            if ($request->file('file') != null && $request->file('file')->isValid()) {

                $extension = $request->file->getClientOriginalExtension();
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                    $fileName = $persona->PE_NUM_DOCU . '.' . $request->file->getClientOriginalExtension();
                    $request->file->storeAS('swacv-fotos', $fileName, 's3', 'public');

                    $persona->PE_URL_FOTO = $fileName;
                } else {
                    $return = [
                        'status' => 'error',
                        'titulo' => '¡Extensión inválida!',
                        'message' => '<strong>Sólo se permiten imagenes con extensiones  jpg ,jpeg ,png !</strong>'
                    ];
                    return $return;
                }
            }

            if (!$persona->save()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($persona->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo registrar los datos personales. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }
            $return = [
                'status' => 'ok',
                'titulo' => '¡Cambios Guardados!',
                'message' => 'Se guardó con éxito!'
            ];

            return response()->json($return);
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Error no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }

    public function prueba(Request $request)
    {

        $user = auth()->user();
        $persona = Persona::where('US_CODIGO', $user->id)->first();
        if ($persona) {
            $data['persona'] = $persona;
        } else {
            $persona_new = new Persona();
            $persona_new->PE_NOMBRES = $user->name;
            $persona_new->PE_CORREO = $user->email;
            $persona_new->US_CODIGO = $user->id;
            $persona_new->save();
            $data['persona'] = $persona_new;
        }
        $data['user'] = $user;

        // $direccion = Direccionxpersona::where('PE_CODIGO', $persona->id)->first();

        return view('PerfilCurricular.prueba', compact('data'));
    }

    public function educacion(Request $request)
    {

        $user = auth()->user();
        $persona = Persona::where('US_CODIGO', $user->id)->first();

        $data['user'] = $user;
        $data['persona'] = $persona;

        $nivel = [
            '' => '[Nivel Alcanzado]',
            'SIN EDUCACIÓN FORMAL' => 'SIN EDUCACIÓN FORMAL',
            'EDUACIÓN ESPECIAL' => 'EDUACIÓN ESPECIAL',
            'ESTUDIOS PRIMARIOS' => 'ESTUDIOS PRIMARIOS',
            'ESTUDIOS SECUNDARIOS' => 'ESTUDIOS SECUNDARIOS ',
            'TÉCNICA BÁSICA (1 ó 2 AÑOS)' => 'TÉCNICA BÁSICA (1 ó 2 AÑOS)',
            'TÉCNICOS / INSTITUTOS (3 a 4 años)' => 'TÉCNICOS / INSTITUTOS (3 a 4 años)',
            'ESCUELA DE FORMACION DE LAS FUERZAS ARMADAS y POLICIA NACIONAL' => 'ESCUELA DE FORMACION DE LAS FUERZAS ARMADAS y POLICIA NACIONAL',
            'UNIVERSITARIO' => 'UNIVERSITARIO',
            'MAESTRÍA' => 'MAESTRÍA',
            'SEGUNDA CARRERA / MAESTRIA' => 'SEGUNDA CARRERA / MAESTRIA',
            'DOCTORADO' => 'DOCTORADO'
        ];
        $data['nivel'] = $nivel;

        $situacion = [
            '' => '[Situacion Académica]',
            "CONCLUIDO / EGRESADO" => "CONCLUIDO / EGRESADO",
            "INCONCLUSO" => "INCONCLUSO",
            "EN CURSO" => "EN CURSO",
            "TÍTULO PROFESIONAL" => "TÍTULO PROFESIONAL",
            "BACHILLER" => "BACHILLER",
        ];
        $data['situacion'] = $situacion;

        $paises = [
            '' => '[Seleccione País]',
            "Afganistán" => "Afganistán",
            "Albania" => "Albania",
            "Alemania" => "Alemania",
            "Andorra" => "Andorra",
            "Angola" => "Angola",
            "Antigua y Barbuda" => "Antigua y Barbuda",
            "Arabia Saudita" => "Arabia Saudita",
            "Argelia" => "Argelia",
            "Argentina" => "Argentina",
            "Armenia" => "Armenia",
            "Australia" => "Australia",
            "Austria" => "Austria",
            "Azerbaiyán" => "Azerbaiyán",
            "Bahamas" => "Bahamas",
            "Bangladés" => "Bangladés",
            "Barbados" => "Barbados",
            "Baréin" => "Baréin",
            "Bélgica" => "Bélgica",
            "Belice" => "Belice",
            "Benín" => "Benín",
            "Bielorrusia" => "Bielorrusia",
            "Birmania" => "Birmania",
            "Bolivia" => "Bolivia",
            "Bosnia y Herzegovina" => "Bosnia y Herzegovina",
            "Botsuana" => "Botsuana",
            "Brasil" => "Brasil",
            "Brunéi" => "Brunéi",
            "Bulgaria" => "Bulgaria",
            "Burkina Faso" => "Burkina Faso",
            "Burundi" => "Burundi",
            "Bután" => "Bután",
            "Cabo Verde" => "Cabo Verde",
            "Camboya" => "Camboya",
            "Camerún" => "Camerún",
            "Canadá" => "Canadá",
            "Catar" => "Catar",
            "Chad" => "Chad",
            "Chile" => "Chile",
            "China" => "China",
            "Chipre" => "Chipre",
            "Ciudad del Vaticano" => "Ciudad del Vaticano",
            "Colombia" => "Colombia",
            "Comoras" => "Comoras",
            "Corea del Norte" => "Corea del Norte",
            "Corea del Sur" => "Corea del Sur",
            "Costa de Marfil" => "Costa de Marfil",
            "Costa Rica" => "Costa Rica",
            "Croacia" => "Croacia",
            "Cuba" => "Cuba",
            "Dinamarca" => "Dinamarca",
            "Dominica" => "Dominica",
            "Ecuador" => "Ecuador",
            "Egipto" => "Egipto",
            "El Salvador" => "El Salvador",
            "Emiratos Árabes Unidos" => "Emiratos Árabes Unidos",
            "Eritrea" => "Eritrea",
            "Eslovaquia" => "Eslovaquia",
            "Eslovenia" => "Eslovenia",
            "España" => "España",
            "Estados Unidos" => "Estados Unidos",
            "Estonia" => "Estonia",
            "Etiopía" => "Etiopía",
            "Filipinas" => "Filipinas",
            "Finlandia" => "Finlandia",
            "Fiyi" => "Fiyi",
            "Francia" => "Francia",
            "Gabón" => "Gabón",
            "Gambia" => "Gambia",
            "Georgia" => "Georgia",
            "Ghana" => "Ghana",
            "Granada" => "Granada",
            "Grecia" => "Grecia",
            "Guatemala" => "Guatemala",
            "Guyana" => "Guyana",
            "Guinea" => "Guinea",
            "Guinea ecuatorial" => "Guinea ecuatorial",
            "Guinea-Bisáu" => "Guinea-Bisáu",
            "Haití" => "Haití",
            "Honduras" => "Honduras",
            "Hungría" => "Hungría",
            "India" => "India",
            "Indonesia" => "Indonesia",
            "Irak" => "Irak",
            "Irán" => "Irán",
            "Irlanda" => "Irlanda",
            "Islandia" => "Islandia",
            "Islas Marshall" => "Islas Marshall",
            "Islas Salomón" => "Islas Salomón",
            "Israel" => "Israel",
            "Italia" => "Italia",
            "Jamaica" => "Jamaica",
            "Japón" => "Japón",
            "Jordania" => "Jordania",
            "Kazajistán" => "Kazajistán",
            "Kenia" => "Kenia",
            "Kirguistán" => "Kirguistán",
            "Kiribati" => "Kiribati",
            "Kuwait" => "Kuwait",
            "Laos" => "Laos",
            "Lesoto" => "Lesoto",
            "Letonia" => "Letonia",
            "Líbano" => "Líbano",
            "Liberia" => "Liberia",
            "Libia" => "Libia",
            "Liechtenstein" => "Liechtenstein",
            "Lituania" => "Lituania",
            "Luxemburgo" => "Luxemburgo",
            "Macedonia del Norte" => "Macedonia del Norte",
            "Madagascar" => "Madagascar",
            "Malasia" => "Malasia",
            "Malaui" => "Malaui",
            "Maldivas" => "Maldivas",
            "Malí" => "Malí",
            "Malta" => "Malta",
            "Marruecos" => "Marruecos",
            "Mauricio" => "Mauricio",
            "Mauritania" => "Mauritania",
            "México" => "México",
            "Micronesia" => "Micronesia",
            "Moldavia" => "Moldavia",
            "Mónaco" => "Mónaco",
            "Mongolia" => "Mongolia",
            "Montenegro" => "Montenegro",
            "Mozambique" => "Mozambique",
            "Namibia" => "Namibia",
            "Nauru" => "Nauru",
            "Nepal" => "Nepal",
            "Nicaragua" => "Nicaragua",
            "Níger" => "Níger",
            "Nigeria" => "Nigeria",
            "Noruega" => "Noruega",
            "Nueva Zelanda" => "Nueva Zelanda",
            "Omán" => "Omán",
            "Países Bajos" => "Países Bajos",
            "Pakistán" => "Pakistán",
            "Palaos" => "Palaos",
            "Panamá" => "Panamá",
            "Papúa Nueva Guinea" => "Papúa Nueva Guinea",
            "Paraguay" => "Paraguay",
            "Perú" => "Perú",
            "Polonia" => "Polonia",
            "Portugal" => "Portugal",
            "Reino Unido" => "Reino Unido",
            "República Centroafricana" => "República Centroafricana",
            "República Checa" => "República Checa",
            "República del Congo" => "República del Congo",
            "República Democrática del Congo" => "República Democrática del Congo",
            "República Dominicana" => "República Dominicana",
            "Ruanda" => "Ruanda",
            "Rumanía" => "Rumanía",
            "Rusia" => "Rusia",
            "Samoa" => "Samoa",
            "San Cristóbal y Nieves" => "San Cristóbal y Nieves",
            "San Marino" => "San Marino",
            "San Vicente y las Granadinas" => "San Vicente y las Granadinas",
            "Santa Lucía" => "Santa Lucía",
            "Santo Tomé y Príncipe" => "Santo Tomé y Príncipe",
            "Senegal" => "Senegal",
            "Serbia" => "Serbia",
            "Seychelles" => "Seychelles",
            "Sierra Leona" => "Sierra Leona",
            "Singapur" => "Singapur",
            "Siria" => "Siria",
            "Somalia" => "Somalia",
            "Sri Lanka" => "Sri Lanka",
            "Suazilandia" => "Suazilandia",
            "Sudáfrica" => "Sudáfrica",
            "Sudán" => "Sudán",
            "Sudán del Sur" => "Sudán del Sur",
            "Suecia" => "Suecia",
            "Suiza" => "Suiza",
            "Surinam" => "Surinam",
            "Tailandia" => "Tailandia",
            "Tanzania" => "Tanzania",
            "Tayikistán" => "Tayikistán",
            "Timor Oriental" => "Timor Oriental",
            "Togo" => "Togo",
            "Tonga" => "Tonga",
            "Trinidad y Tobago" => "Trinidad y Tobago",
            "Túnez" => "Túnez",
            "Turkmenistán" => "Turkmenistán",
            "Turquía" => "Turquía",
            "Tuvalu" => "Tuvalu",
            "Ucrania" => "Ucrania",
            "Uganda" => "Uganda",
            "Uruguay" => "Uruguay",
            "Uzbekistán" => "Uzbekistán",
            "Vanuatu" => "Vanuatu",
            "Venezuela" => "Venezuela",
            "Vietnam" => "Vietnam",
            "Yemen" => "Yemen",
            "Yibuti" => "Yibuti",
            "Zambia" => "Zambia",
            "Zimbabue" => "Zimbabue",
        ];
        $data['paises'] = $paises;

        $tipo_idioma = [
            '' => '[Seleccione tipo]',
            "NATIVO" => "NATIVO",
            "ESTUDIO" => "ESTUDIO"
        ];
        $data['tipo_idioma'] = $tipo_idioma;

        $nivel_idioma = [
            '' => '[Seleccione nivel]',
            "BASICO" => "BASICO",
            "INTERMEDIO" => "INTERMEDIO",
            "AVANZADO" => "AVANZADO",
            "NATIVO" => "NATIVO"
        ];
        $data['nivel_idioma'] = $nivel_idioma;

        $modalidad_idioma = [
            '' => '[Seleccione modalidad]',
            "VIRTUAL" => "VIRTUAL",
            "PRESENCIAL" => "PRESENCIAL",
            "SEMIPRESENCIAL" => "SEMIPRESENCIAL",
            "NO APLICA" => "NO APLICA"
        ];
        $data['modalidad_idioma'] = $modalidad_idioma;

        $tipo_intereses = [
            '' => '[Seleccione interés]',
            "LECTURA" => "LECTURA",
            "MÚSICA" => "MÚSICA",
            "COCINA" => "COCINA",
            "FOTOGRAFIA" => "FOTOGRAFIA",
            "DEPORTES" => "DEPORTES",
            "BAILE" => "BAILE",
            "ESCRITURA" => "ESCRITURA",
            "PINTURA" => "PINTURA",
            "VIAJAR" => "VIAJAR",
            "NATURALEZA" => "NATURALEZA",
            "CINE" => "CINE"
        ];
        $data['tipo_intereses'] = $tipo_intereses;

        $estudiostabla = Estudiosxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['estudios'] = $estudiostabla;

        $idiomastabla = Idiomasxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['idiomas'] = $idiomastabla;

        $interesestabla = Interesesxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['intereses'] = $interesestabla;

        return view('PerfilCurricular.educacion', compact('data'));
    }

    public function agregar_estudios(Request $request)
    {
        try {
            $id = $request->sesion;
            $persona = Persona::where('PE_CODIGO', '=', $id)->first();

            if (!$persona) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Alerta!',
                    'message' => 'No se encontró a la persona',
                    'persona' => $persona,
                    'sesion' => $id
                ];
                return response()->json($return);
            }

            if (empty($request->formacion)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: FORMACION'
                ];
                return $return;
            }
            if (empty($request->situacion)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: SITUACION'
                ];
                return $return;
            }
            if (empty($request->pais)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: PAIS'
                ];
                return $return;
            }
            if (empty($request->centro)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: CENTRO DE ESTUDIOS '
                ];
                return $return;
            }
            if (empty($request->estudio_anio_ini)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: AÑO INICIO'
                ];
                return $return;
            }


            $estudio = new Estudiosxpersona();
            $estudio->EST_FORMACION = $request->formacion;
            $estudio->EST_SITUACION = $request->situacion;
            $estudio->EST_PROFESION = mb_strtoupper($request->carrera, 'UTF-8');
            $estudio->EST_CENTRO_ESTU = mb_strtoupper($request->centro, 'UTF-8');
            $estudio->EST_PAIS_ESTU = $request->pais;
            $estudio->EST_ANIO_INICIO = $request->estudio_anio_ini;
            $estudio->EST_ANIO_FIN = $request->estudio_anio_fin;
            $estudio->PE_CODIGO = $persona->PE_CODIGO;

            if (!$estudio->save()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($estudio->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo registrar el Estudio. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }

            $return = [
                'status' => 'ok',
                'titulo' => '¡Registro Exitoso!',
                'message' => 'Se registró el Estudio!'
            ];
            return $return;
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Registro no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }


    public function eliminar_estudios(Request $request)
    {

        try {

            $estudio = Estudiosxpersona::find($request->estudio_id);

            if (!$estudio->delete()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($estudio->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo eliminar el estudio. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Proceso no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }
            $return = [
                'status' => 'ok',
                'titulo' => 'Eliminación Exitosa!',
                'message' => 'Se eliminó el estudio correctamente!'
            ];
            return $return;
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => 'Eliminación no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }

    public function agregar_idioma(Request $request)
    {
        try {
            $id = $request->sesion_idioma;
            $persona = Persona::where('PE_CODIGO', '=', $id)->first();

            if (!$persona) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Alerta!',
                    'message' => 'No se encontró a la persona',
                    'persona' => $persona,
                    'sesion' => $id
                ];
                return response()->json($return);
            }

            if (empty($request->idioma)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: NOMBRE DEL IDIOMA'
                ];
                return $return;
            }

            if (empty($request->nivel_idioma)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: NIVEL DEL IDIOMA'
                ];
                return $return;
            }
            if (empty($request->modalidad_idioma)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: MODALIDAD IDIOMA '
                ];
                return $return;
            }



            $idioma = new Idiomasxpersona();
            $idioma->IDI_IDIOMA = mb_strtoupper($request->idioma, 'UTF-8');
            $idioma->IDI_NIVEL = $request->nivel_idioma;
            $idioma->IDI_MODALIDAD = $request->modalidad_idioma;
            $idioma->IDI_CENTRO = $request->centro_idioma;
            $idioma->PE_CODIGO = $persona->PE_CODIGO;

            if (!$idioma->save()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($idioma->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo registrar el idioma. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }

            $return = [
                'status' => 'ok',
                'titulo' => '¡Registro Exitoso!',
                'message' => 'Se registró el idioma!'
            ];
            return $return;
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Registro no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }


    public function eliminar_idioma(Request $request)
    {

        try {

            $idioma = Idiomasxpersona::find($request->idioma_elim);

            if (!$idioma->delete()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($idioma->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo eliminar el idioma. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Proceso no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }
            $return = [
                'status' => 'ok',
                'titulo' => 'Eliminación Exitosa!',
                'message' => 'Se eliminó el idioma correctamente!'
            ];
            return $return;
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => 'Eliminación no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }

    public function agregar_interes(Request $request)
    {
        try {
            $id = $request->sesion_interes;
            $persona = Persona::where('PE_CODIGO', '=', $id)->first();

            if (!$persona) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Alerta!',
                    'message' => 'No se encontró a la persona',
                    'persona' => $persona,
                    'sesion' => $id
                ];
                return response()->json($return);
            }

            if (empty($request->tipo_interes)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: TIPO INTERES'
                ];
                return $return;
            }

            if (empty($request->descripcion_interes)) {
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'No se están enviando campos obligatorios: DESCRIPCION'
                ];
                return $return;
            }

            $interes = new Interesesxpersona();
            $interes->INTE_TIPO = $request->tipo_interes;
            $interes->INTE_DESCRIPCION = $request->descripcion_interes;
            $interes->PE_CODIGO = $persona->PE_CODIGO;

            if (!$interes->save()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($interes->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo registrar el interes. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Registro no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }

            $return = [
                'status' => 'ok',
                'titulo' => '¡Registro Exitoso!',
                'message' => 'Se registró el interes!'
            ];
            return $return;
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => '¡Registro no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }

    public function eliminar_interes(Request $request)
    {

        try {

            $interes = Interesesxpersona::find($request->interes_elim);

            if (!$interes->delete()) {
                $msg = '';
                if ($this->ENVIRONMENT_DEBUG) {
                    foreach ($interes->getMessages() as $message) {
                        $msg = $msg . $message . "</br>\n";
                    }
                } else {
                    $msg = "No se pudo eliminar el interes. </br>\n";
                }
                $return = [
                    'status' => 'error',
                    'titulo' => '¡Proceso no completado!',
                    'message' => 'Obtenemos el siguiente error: ' . $msg . '<br /><strong>NO se ha realizado ningún cambio en la base de datos!</strong>'
                ];

                return $return;
            }
            $return = [
                'status' => 'ok',
                'titulo' => 'Eliminación Exitosa!',
                'message' => 'Se eliminó el interes correctamente!'
            ];
            return $return;
        } catch (Exception $ex) {
            $return = [
                'status' => 'error',
                'titulo' => 'Eliminación no completado!',
                'message' => $ex->getMessage()
            ];
            return $return;
        }
    }
    public function ver_ficha($id)
    {

        $persona = Persona::find($id);
        $data['persona'] = $persona;

        $estudiostabla = Estudiosxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['estudios'] = $estudiostabla;

        $idiomastabla = Idiomasxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['idiomas'] = $idiomastabla;

        $interesestabla = Interesesxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['intereses'] = $interesestabla;

        $datos = Persona::where('PE_CODIGO', $persona->id)->first();


        // if ($persona) {


        //     $dia_naci = date_create($datos->PE_FNACIMIENTO);
        //     $data['dia_nacimiento'] = date_format($dia_naci, 'd');

        //     $mes_naci = date_create($datos->PE_FNACIMIENTO);
        //     $data['mes_nacimiento'] = date_format($mes_naci, 'm');

        //     $anio_naci = date_create($datos->PE_FNACIMIENTO);
        //     $data['anio_nacimiento'] = date_format($anio_naci, 'Y');

        //     $direccion_persona = Direccionxpersona::where([['PE_CODIGO', $persona->id]])->first();
        //     $data['direccion_persona'] = $direccion_persona;

        //     if ($direccion_persona->CONPE_TIPO_ZONA) {
        //         $tipo_zona = $direccion_persona->CONPE_TIPO_ZONA;
        //     } else {
        //         $tipo_zona = ' ';
        //     }

        //     if ($direccion_persona->CONPE_NOMB_ZONA) {
        //         $nombre_zona = $direccion_persona->CONPE_NOMB_ZONA;
        //     } else {
        //         $nombre_zona = ' ';
        //     }

        //     if ($direccion_persona->CONPE_TIPO_VIA) {
        //         $tipo_via = $direccion_persona->CONPE_TIPO_VIA;
        //     } else {
        //         $tipo_via = ' ';
        //     }

        //     if ($direccion_persona->CONPE_NOMB_VIA) {
        //         $nombre_via = $direccion_persona->CONPE_NOMB_VIA;
        //     } else {
        //         $nombre_via = ' ';
        //     }

        //     if ($direccion_persona->CONPE_KM) {
        //         $km = $direccion_persona->CONPE_KM;
        //     } else {
        //         $km = ' ';
        //     }

        //     if ($direccion_persona->CONPE_MZ) {
        //         $mz = $direccion_persona->CONPE_MZ;
        //     } else {
        //         $mz = ' ';
        //     }

        //     if ($direccion_persona->CONPE_LOTE) {
        //         $lote = $direccion_persona->CONPE_LOTE;
        //     } else {
        //         $lote = ' ';
        //     }


        //     $data['direccion_cercana'] = $tipo_zona . ' ' . $nombre_zona . ' ' . $tipo_via . ' ' . $nombre_via . ', Km ' . $km . ' Mz ' . $mz . ' Lote ' . $lote;


        //     $estudios_personales = Estudiosxpersona::where([['PE_CODIGO', $persona->id]])->get();
        //     $data['estudios_personales'] = $estudios_personales;

        //     $estudios_ffaa = Estudiosxpersona::where([['PE_CODIGO', $persona->id]])
        //     ->where('ESPE_NIVEL', 'ESCUELA DE FORMACION DE LAS FUERZAS ARMADAS y POLICIA NACIONAL')->first();
        //     $data['estudios_ffaa'] = $estudios_ffaa;
        //     // $data['estudios_ffaa_folio'] = $estudios_ffaa->ESPE_NUM_FOLIO;


        //     $estudios_ffaa_folio = Estudiosxpersona::where([['PE_CODIGO', $persona->id]])
        //     ->where('ESPE_NIVEL', 'ESCUELA DE FORMACION DE LAS FUERZAS ARMADAS y POLICIA NACIONAL')->first();
        //     if($estudios_ffaa_folio){
        //         $data['estudios_ffaa_folio'] = $estudios_ffaa_folio->ESPE_NUM_FOLIO;
        //     }else{
        //         $data['estudios_ffaa_folio'] = '-';
        //     }


        //     if ($persona->PE_COLEGIATURA == 1) {
        //         $data['colegio'] = $persona->PE_NAME_COLEG;
        //         $data['num_coleg'] = $persona->PE_NUM_COLEG;
        //     } else if ($persona->PE_COLEGIATURA == 0) {
        //         $data['colegio'] = '--';
        //         $data['num_coleg'] = '--';
        //     }



        //     $especialidades = Especializacionxpersona::where([['PE_CODIGO', $persona->id]])->get();
        //     $data['especialidades'] = $especialidades;

        //     $conocimientos = Conoci_noacxpersona::where([['PE_CODIGO', $persona->id]])->get();
        //     $data['conocimientos'] = $conocimientos;

        //     $experiencia_laboral_especifica = ExperienciaLabxpersona::where('PE_CODIGO', $persona->id)->where('EXPELAPE_TIPO', 'ESPECIFICA')
        //         ->get();
        //     $data['experiencia_laboral_especifica'] = $experiencia_laboral_especifica;

        //     $experiencia_laboral_general = ExperienciaLabxpersona::where('PE_CODIGO', $persona->id)->get();
        //     $data['experiencia_laboral_general'] = $experiencia_laboral_general;
        // }

        $pdf = PDF::loadView('reportes.ficha2', compact('data'));
        return $pdf->stream('Curriculum_Vitae_SWACV.pdf');
    }
    public function descargar_ficha($id)
    {

        $persona = Persona::find($id);
        $data['persona'] = $persona;

        $estudiostabla = Estudiosxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['estudios'] = $estudiostabla;

        $idiomastabla = Idiomasxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['idiomas'] = $idiomastabla;

        $interesestabla = Interesesxpersona::where('PE_CODIGO', $persona->PE_CODIGO)
            ->get();
        $data['intereses'] = $interesestabla;

        $datos = Persona::where('PE_CODIGO', $persona->id)->first();



        // if ($persona) {


        //     $dia_naci = date_create($datos->PE_FNACIMIENTO);
        //     $data['dia_nacimiento'] = date_format($dia_naci, 'd');

        //     $mes_naci = date_create($datos->PE_FNACIMIENTO);
        //     $data['mes_nacimiento'] = date_format($mes_naci, 'm');

        //     $anio_naci = date_create($datos->PE_FNACIMIENTO);
        //     $data['anio_nacimiento'] = date_format($anio_naci, 'Y');

        //     $direccion_persona = Direccionxpersona::where([['PE_CODIGO', $persona->id]])->first();
        //     $data['direccion_persona'] = $direccion_persona;

        //     if ($direccion_persona->CONPE_TIPO_ZONA) {
        //         $tipo_zona = $direccion_persona->CONPE_TIPO_ZONA;
        //     } else {
        //         $tipo_zona = ' ';
        //     }

        //     if ($direccion_persona->CONPE_NOMB_ZONA) {
        //         $nombre_zona = $direccion_persona->CONPE_NOMB_ZONA;
        //     } else {
        //         $nombre_zona = ' ';
        //     }

        //     if ($direccion_persona->CONPE_TIPO_VIA) {
        //         $tipo_via = $direccion_persona->CONPE_TIPO_VIA;
        //     } else {
        //         $tipo_via = ' ';
        //     }

        //     if ($direccion_persona->CONPE_NOMB_VIA) {
        //         $nombre_via = $direccion_persona->CONPE_NOMB_VIA;
        //     } else {
        //         $nombre_via = ' ';
        //     }

        //     if ($direccion_persona->CONPE_KM) {
        //         $km = $direccion_persona->CONPE_KM;
        //     } else {
        //         $km = ' ';
        //     }

        //     if ($direccion_persona->CONPE_MZ) {
        //         $mz = $direccion_persona->CONPE_MZ;
        //     } else {
        //         $mz = ' ';
        //     }

        //     if ($direccion_persona->CONPE_LOTE) {
        //         $lote = $direccion_persona->CONPE_LOTE;
        //     } else {
        //         $lote = ' ';
        //     }


        //     $data['direccion_cercana'] = $tipo_zona . ' ' . $nombre_zona . ' ' . $tipo_via . ' ' . $nombre_via . ', Km ' . $km . ' Mz ' . $mz . ' Lote ' . $lote;


        //     $estudios_personales = Estudiosxpersona::where([['PE_CODIGO', $persona->id]])->get();
        //     $data['estudios_personales'] = $estudios_personales;

        //     $estudios_ffaa = Estudiosxpersona::where([['PE_CODIGO', $persona->id]])
        //     ->where('ESPE_NIVEL', 'ESCUELA DE FORMACION DE LAS FUERZAS ARMADAS y POLICIA NACIONAL')->first();
        //     $data['estudios_ffaa'] = $estudios_ffaa;
        //     // $data['estudios_ffaa_folio'] = $estudios_ffaa->ESPE_NUM_FOLIO;


        //     $estudios_ffaa_folio = Estudiosxpersona::where([['PE_CODIGO', $persona->id]])
        //     ->where('ESPE_NIVEL', 'ESCUELA DE FORMACION DE LAS FUERZAS ARMADAS y POLICIA NACIONAL')->first();
        //     if($estudios_ffaa_folio){
        //         $data['estudios_ffaa_folio'] = $estudios_ffaa_folio->ESPE_NUM_FOLIO;
        //     }else{
        //         $data['estudios_ffaa_folio'] = '-';
        //     }


        //     if ($persona->PE_COLEGIATURA == 1) {
        //         $data['colegio'] = $persona->PE_NAME_COLEG;
        //         $data['num_coleg'] = $persona->PE_NUM_COLEG;
        //     } else if ($persona->PE_COLEGIATURA == 0) {
        //         $data['colegio'] = '--';
        //         $data['num_coleg'] = '--';
        //     }



        //     $especialidades = Especializacionxpersona::where([['PE_CODIGO', $persona->id]])->get();
        //     $data['especialidades'] = $especialidades;

        //     $conocimientos = Conoci_noacxpersona::where([['PE_CODIGO', $persona->id]])->get();
        //     $data['conocimientos'] = $conocimientos;

        //     $experiencia_laboral_especifica = ExperienciaLabxpersona::where('PE_CODIGO', $persona->id)->where('EXPELAPE_TIPO', 'ESPECIFICA')
        //         ->get();
        //     $data['experiencia_laboral_especifica'] = $experiencia_laboral_especifica;

        //     $experiencia_laboral_general = ExperienciaLabxpersona::where('PE_CODIGO', $persona->id)->get();
        //     $data['experiencia_laboral_general'] = $experiencia_laboral_general;
        // }

        $pdf = PDF::loadView('reportes.ficha2', compact('data'));
        return $pdf->download('Curriculum_Vitae_SWACV.pdf');
    }
}
