@extends('layouts.main')
@section('usuario')
    {{ isset($data['persona']->PE_NOMBRES) ? $data['persona']->PE_NOMBRES : $data['user']->name }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-edit text-warning nav-icon"></i> Curriculum Prueba</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Perfil Curricular</a></li>
                        <li class="breadcrumb-item active">Curriculum Prueba</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid d-flex justify-content-center" >
            <div class="col-md-6">

                <div class="card card-widget widget-user-2 shadow-lg">

                    <div class="widget-user-header bg-primary">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('adminlte/dist/img/avatar.png') }}" alt="User Avatar">
                        </div>

                        <h3 class="widget-user-username">CURRICULUM VITAE</h3>
                        <h5 class="widget-user-desc">{{$data['persona']->fullname}}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span  class="nav-link font-weight-bold">
                                    DNI <span class="float-right badge bg-primary">{{$data['persona']->PE_NUM_DOCU}}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    Correo <span class="float-right badge bg-info">{{$data['persona']->PE_CORREO}}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    Estado Civil <span class="float-right badge bg-success">{{$data['persona']->PE_ESTADO_CIV}}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    Sexo <span class="float-right badge bg-danger">{{$data['persona']->PE_SEXO}}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    Fecha Nacimiento <span class="float-right badge bg-light">{{$data['persona']->getFechaNacimiento()}}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    Nacionalidad <span class="float-right badge bg-light text-uppercase"> {{$data['persona']->PE_CIUD_NACION}} - {{$data['persona']->PE_PAIS_NACION}}</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
@section('scripts')
    {{-- select2 --}}
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- js --}}
    <script src="{{ asset('adminlte/dist/js/PerfilCurricular/datos_generales/datos_generales.js') }}"></script>

    {{-- jqueryvalidate --}}
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/localization/messages_es_PE.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/localization/methods_es_CL.min.js') }}"></script>
@endsection
