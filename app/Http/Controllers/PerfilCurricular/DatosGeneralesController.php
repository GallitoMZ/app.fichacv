<?php

namespace App\Http\Controllers\PerfilCurricular;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Util\CommonController;
use App\Models\Persona;
use Exception;
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
            $persona_new->PE_NOMBRES=$user->name;
            $persona_new->PE_CORREO=$user->email;
            $persona_new->US_CODIGO=$user->id;
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
            $persona_new->PE_NOMBRES=$user->name;
            $persona_new->PE_CORREO=$user->email;
            $persona_new->US_CODIGO=$user->id;
            $persona_new->save();
            $data['persona'] = $persona_new;
        }
        $data['user'] = $user;




        // $direccion = Direccionxpersona::where('PE_CODIGO', $persona->id)->first();

        return view('PerfilCurricular.prueba', compact('data'));
    }
}

