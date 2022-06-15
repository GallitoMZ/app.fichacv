<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>SIWAPOCV</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            color: #fff;
            font-weight: 200;
        }
        .title2 {
            font-size: 42px;
            color: #fff;
            font-weight: 200;
        }
        .links>a {
            color: #282829;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
</head>

<body style="background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);">
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Pagina Principal</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registro</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                SWAPOCV
            </div>
            <div class="title2 m-b-md">
                Sistema Web de Administración de Portafolio y Curriculum Vitae
            </div>
            <div class="links">
                <a href="https://laravel.com/docs">Documentacion</a>
                <a href="https://sistemas.unmsm.edu.pe/site/index.php">FISI UNMSM</a>
                <a href="https://aws.amazon.com/es/">AWS</a>
                <a href="https://github.com/GallitoMZ/app.fichacv">GitHub</a>
            </div>
        </div>
    </div>

</body>

</html>
