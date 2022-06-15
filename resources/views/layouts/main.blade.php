<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2-bootstrap.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center" style="background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);">
            <img class="animation__shake " src="{{ asset('adminlte/dist/img/logo/logo.svg') }}" alt="AdminLTELogo" height="120" width="120">
            <h3 class="animation__shake ">Sistema web de Administracion de Curriculum Vitae</h3>
        </div> --}}
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">
                        <span class="right badge badge-primary">Sistema Web de Administracion de Portafolio y Curriculum Vitae</span>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link text-center">
                {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8"> --}}
                <i class="fas fa-book text-success "></i>

                <span class="brand-text font-weight-normal">SIWAPOCV</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('adminlte/dist/img/avatar.png') }}" class="img-circle elevation-2"
                            alt="User Image">

                    </div>
                    <div class="info">
                        <a href="#" class="d-block">@yield('usuario')</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Página Principal
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a href="#perfil" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Perfil Curricular<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('formulario.datos_generales') }}" class="nav-link">
                                        <i class="fas fa-user-edit text-yellow nav-icon"></i>
                                        <p>Datos Generales</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('formulario.educacion') }}" class="nav-link">
                                        <i class="fas fa-user-graduate text-yellow nav-icon"></i>
                                        <p>Educacion</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('formulario.datos_generales.prueba')}}" class="nav-link">
                                        <i class="far fa-file-pdf text-yellow nav-icon"></i>
                                        <p>Curriculum Prueba</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('formulario.dinamica')}}" class="nav-link">
                                        <i class="fas fa-chart-pie text-yellow nav-icon"></i>
                                        <p>Dinamica</p>
                                    </a>
                                </li>


                                {{-- <li class="nav-item menu-open">
                                    <a href="#labo" class="nav-link ">
                                        <i class="fas fa-briefcase text-yellow nav-icon"></i>
                                        <p>
                                            Datos Laborales
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" >
                                        <li class="nav-item">
                                            <a href="#laborales" class="nav-link">
                                                <i class="fas fa-user-tie text-success nav-icon"></i>
                                                <p>Experiencia Laboral </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> --}}

                                {{-- <li class="nav-item">
                                    <a href="#cur" class="nav-link">
                                        <i class="fas fa-file-archive text-yellow nav-icon"></i>
                                        <p>Documentos Curriculares</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline">
                                @csrf
                                <a href="#" class="nav-link" onclick="this.closest('form').submit()">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </form>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                -
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022-2022 <a href="#">SIWAPOCV</a>.</strong> Todos los derechos reservados
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    @yield('scripts')
</body>

</html>
