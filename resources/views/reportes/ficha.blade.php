<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 10px;
        }

        .cuerpo {
            max-width: 1000px;
            margin: auto;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 0px;
            height: 50px;
            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            /* color: white; */
            text-align: center;
            line-height: 35px;
        }

        @page {
            margin-top: 25px;

        }

        .page-break {
            page-break-after: always;
        }

        #tablita {
            width: 100%;
        }

        #tablita td {
            width: 100%;
            border: 1px solid #000;
            background-color: #ffffff;
        }

        .tablaborder {
            width: 100%;
        }

        .tablaborder td {
            height: 25px;
            background-color: #ffffff;
        }

        .tablaborder th {
            height: 25px;
            font-size: 11px;
            background-color: #e7d8b8;
        }

    </style>
</head>

<body>
    <footer>
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 20%; text-align: left;">
                        SWACV - Online
                    </td>
                    <td style="width: 40%; text-align: justify;padding:5px"></td>
                    <td style="width: 30%; text-align: right;">
                        <img src="{{ asset('adminlte/dist/img/logo/logo.svg') }}">
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>
    <main>
        <br>
        <p class="title" style="text-align: center;"><span style="text-decoration: underline; color: #000000;">
                <h1><strong>Curriculum Vitae</strong></h1>
            </span></p>
        <br>




        <table style=" width: 40.341%; height: 18px;">
            <tbody>
                <tr>
                    <td
                        style="width: 100%;height: 18px;border: 1px solid black;background-color: #b4e6c5">
                        <b>&nbsp;DATOS GENERALES</b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; height: 36px; padding-left: 15px">
            <tbody>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;border: 0px solid black;" colspan="2">Nombres y Apellidos</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">DNI</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Sexo</td>
                </tr>
                <tr style="height: 18px; ">
                    <td style="width: 50%; height: 18px;border: 1px solid black;" colspan="2">
                        <b>&nbsp;{{ $data['persona']->fullname }}</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->PE_NUM_DOCU }}</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->PE_SEXO }}</b>
                    </td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Departamento</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Provincia</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Distrito</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Edad</td>

                </tr>
                <tr style="height: 18px;">
                    <td style="width:25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;;">
                        <b>&nbsp;</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->Edad }}</b>
                    </td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Nacionalidad</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Telefono Celular</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Estado Civil</td>
                    <td style="width: 25%; height: 18px;border: 0px solid black;">Correo</td>

                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->PE_PAIS_NACION }}</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->PE_NUM_CEL }}</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->PE_ESTADO_CIV }}</b>
                    </td>
                    <td style="width: 25%; height: 18px;border: 1px solid black;">
                        <b>&nbsp;{{ $data['persona']->PE_CORREO }}</b>
                    </td>
                </tr>

            </tbody>
        </table>
        <br>

        <table style=" width: 40.341%; height: 18px;">
            <tbody>
                <tr>
                    <td
                        style="width: 100%;height: 18px;border: 1px solid black;background-color: #b4e6c5;">
                        <b>&nbsp;DATOS IMPORTANTES</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <table border="1" align="center" cellpadding="10">

            <tr>
                <th height="120" bgcolor="BurlyWood"> Datos Academicos : </th>
                <td colspan="6">
                    <p> Amo las computadoras, amo las computadoras, amo las computadoras, amo las computadoras, amo las
                        computadoras, amo las computadoras </p>
                    <p> Amo las computadoras, amo las computadoras, amo las computadoras, amo las computadoras, amo las
                        computadoras, amo las computadoras </p>
                    <p> Amo las computadoras, amo las computadoras, amo las computadoras, amo las computadoras, amo las
                        computadoras, amo las computadoras </p>
                </td>
            </tr>
            <tr>
                <th height="120" bgcolor="BurlyWood"> Experiencia personal: </th>
                <td colspan="6">
                    <p> Amo las computadoras, amo las computadoras, amo las computadoras, amo las computadoras, amo las
                        computadoras, amo las computadoras </p>
                    <p> Amo las computadoras, amo las computadoras, amo las computadoras, amo las computadoras, amo las
                        computadoras, amo las computadoras </p>
                    <p> Amo las computadoras, amo las computadoras, amo las computadoras, amo las computadoras, amo las
                        computadoras, amo las computadoras </p>
                </td>
            </tr>

            <tr>
                <th height="120" bgcolor="BurlyWood"> Preséntame: </th>
                <td colspan="6">
                    <p> Desde un pequeño pueblo en la ciudad de Xindian, provincia de Anhui, amo las computadoras, amo
                    </p>
                    <p> Desde un pequeño pueblo en la ciudad de Xindian, provincia de Anhui, amo las computadoras, amo
                    </p>
                    <p> Desde un pequeño pueblo en la ciudad de Xindian, provincia de Anhui, amo las computadoras, amo
                    </p>
            </tr>

            <tr>
                <th height="120" bgcolor="BurlyWood"> Resumen: </th>
                <td colspan="6">
                    <p> Desde un pequeño pueblo en la ciudad de Xindian, provincia de Anhui, amo las computadoras, amo
                    </p>
                    <p> Desde un pequeño pueblo en la ciudad de Xindian, provincia de Anhui, amo las computadoras, amo
                    </p>
                    <p> Desde un pequeño pueblo en la ciudad de Xindian, provincia de Anhui, amo las computadoras, amo
                    </p>
            </tr>
        </table>
    </main>

</body>

</html>
