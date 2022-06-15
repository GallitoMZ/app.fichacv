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
        <div class="container-fluid d-flex justify-content-center">
            <div class="col-md-6">

                <div class="card card-widget widget-user-2 shadow-sm">

                    <div class="widget-user-header bg-gradient-info">
                        <div class="widget-user-image">

                            @if (isset($data['persona']->Foto) && $data['persona']->Foto != '')
                                <img src="{{ $data['persona']->Foto }}" class="img-circle elevation-2">
                            @else
                                <img src="{{ asset('adminlte/dist/img/avatar5.png') }}" class="img-circle elevation-2">
                            @endif
                        </div>

                        <h3 class="widget-user-username">CURRICULUM VITAE</h3>
                        <h5 class="widget-user-desc">{{ $data['persona']->fullname }}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold badge-primary">
                                    PERFIL PROFESIONAL
                                </span>
                                <span class="nav-link font-weight-normal text-justify">
                                    {{ $data['persona']->PE_PERFIL }}
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold badge-primary">
                                    DATOS GENERALES
                                </span>

                            </li>
                            <li class="nav-item">
                                <span class="nav-link ">
                                    <span class="badge badge-info">DNI</span> <span
                                        class="float-right badge">{{ $data['persona']->PE_NUM_DOCU }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    <span class="badge badge-info">Correo</span> <span
                                        class="float-right badge">{{ $data['persona']->PE_CORREO }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    <span class="badge badge-info">Estado Civil</span> <span
                                        class="float-right badge ">{{ $data['persona']->PE_ESTADO_CIV }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    <span class="badge badge-info">Sexo</span> <span
                                        class="float-right badge">{{ $data['persona']->PE_SEXO }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    <span class="badge badge-info">Fecha Nacimiento</span><span
                                        class="float-right badge ">{{ $data['persona']->getFechaNacimiento() }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold">
                                    <span class="badge badge-info">Nacionalidad</span> <span class="float-right badge bg-light text-uppercase">
                                        {{ $data['persona']->PE_CIUD_NACION }} -
                                        {{ $data['persona']->PE_PAIS_NACION }}</span>
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold badge-primary">
                                    ESTUDIOS
                                </span>
                                <ul>
                                    @foreach ($data['estudios'] as $row)
                                        <li>
                                            <span class="nav-link">
                                                {{ $row->EST_FORMACION }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                            </li>
                            <li class="nav-item">
                                <span class="nav-link font-weight-bold badge-primary">
                                    IDIOMAS
                                </span>
                                <ul>
                                    @foreach ($data['idiomas'] as $row)
                                        <li>
                                            <span class="nav-link ">
                                                {{ $row->IDI_IDIOMA }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                        <hr>

                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-outline-primary btn-lg " disabled
                onclick="window.open('{{ route('formulario.datos_generales.ver_ficha', $data['persona']->id) }}')">
                <i class="fas fa-file-pdf"></i> &nbsp;
                Ver CV</button>
            <span style="width: 2%"></span>
            <button type="button" class="btn bg-gradient-success btn-lg " disabled
                onclick="window.open('{{ route('formulario.datos_generales.descargar_ficha', $data['persona']->id) }}')">
                <i class="fas fa-download"></i> &nbsp;
                Descargar CV</button>
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
