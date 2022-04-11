@extends('layouts.main')
@section('usuario')
    {{ isset($data['persona']->PE_NOMBRES) ? $data['persona']->PE_NOMBRES : $data['user']->name }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


    {{-- jquery-confirm --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-confirm/jquery-confirm.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-edit text-warning nav-icon"></i> Datos Generales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Perfil Curricular</a></li>
                        <li class="breadcrumb-item active">Datos Generales</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {!! Form::open(['route' => ['formulario.datos_generales.guardar'], 'id' => 'modal_form_guardar', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="card-deck">
                <div class="card col-md-3 card-primary card-outline">

                    <div class="card-header text-center">
                        <h5 class="card-title text-primary m-0">FOTO</h5>
                    </div>
                    <div class="card-body ">

                        <div class="form-row">
                            <input type="hidden" name="pers_id" id="pers_id" value="{{ $data['persona']->id }}" />
                            <input type="hidden" name="existe_foto" id="existe_foto_id"
                                value="{{ isset($data['persona']->PE_URL_FOTO) ? $data['persona']->PE_URL_FOTO : '' }}" />

                            <div class="form-group col-md">
                                <div class="text-center">
                                    @if (isset($data['persona']->Foto) && $data['persona']->Foto != '')
                                        <img src="{{ $data['persona']->Foto }}"
                                            class="profile-user-img img-fluid img-thumbnail"
                                            style="width: 150px;height: 150px;" alt="User Image" id="imagen_preview_id">
                                    @else
                                        <img src="{{ asset('adminlte/dist/img/avatar5.png') }}"
                                            class="profile-user-img img-fluid img-circle"
                                            style="width: 150px;height: 150px;" alt="User Image" id="imagen_preview_id">
                                    @endif

                                </div>

                                <h3 class="profile-username text-center"><span
                                        class="font-weight-bold text-uppercase ml-4 text-success">
                                        {{ $data['persona']->PE_NOMBRES }} {{ $data['persona']->PE_APELLIDO_P }}
                                        {{ $data['persona']->PE_APELLIDO_M }} </span></h3>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="form-group">
                                    <input name="file" type="file" id="modal_form_documento_file" accept=".png, .jpg, .jpeg"
                                        required>
                                    <span class="text-muted text-sm"><b><i class="bi bi-info-circle"></i>
                                            Recomendaciones:</b>
                                        <br>
                                        <i class="bi bi-check2"></i> Adjuntar en formato jpg , jpeg o png <br>
                                        <i class="bi bi-check2"></i> Considerar un tamaño menor a 10MB
                                    </span>
                                    <br>
                                </div>
                            </div>
                            <div id="preview"></div>
                            {{-- <div class="text-center">
                                <button type="submit" class="btn btn-success">Subir Foto</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card col-md-9 card-primary card-outline">
                    <div class="card-header text-center">
                        <h5 class="card-title text-primary m-0">DATOS GENERALES</h5>
                    </div>
                    <div class="card-body ">

                        <span style="font-weight: bold;"><i class="fas fa-user text-success" style="padding-right: 7px;">
                            </i> DATOS PERSONALES </span> <small> <span class="float-right" style="color:darkgray">(*)
                                Campos Obligatorios</span></small>
                        <hr class="mt-2 mb-2">

                        <input type="hidden" name="persona_codigo" id="persona_codigo_id"
                            value="{{ $data['persona']->PE_CODIGO }}">
                        <div class="form-row">
                            <div class="form-group col-md">

                                <label class="col-form-label col-form-label-sm ">Apellido Paterno:
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('apellidopater', isset($data['persona']->PE_APELLIDO_P) ? $data['persona']->PE_APELLIDO_P : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Apellido paterno', 'required', 'id' => 'apellidop_id']) !!}

                            </div>
                            <div class="form-group col-md">

                                <label class="col-form-label col-form-label-sm ">Apellido Materno:
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('apellidomater', isset($data['persona']->PE_APELLIDO_M) ? $data['persona']->PE_APELLIDO_M : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Apellido materno', 'required', 'id' => 'apellidom_id']) !!}
                            </div>
                            <div class="form-group col-md">

                                <label class="col-form-label col-form-label-sm ">Nombres:
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('nombre', isset($data['persona']->PE_NOMBRES) ? $data['persona']->PE_NOMBRES : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Ingrese nombres', 'required', 'id' => 'nombre_id']) !!}

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Nacionalidad :(Pais
                                        de Origen)
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('paisNacimiento', $data['paises_eleccion'], isset($data['persona']->PE_PAIS_NACION) ? $data['persona']->PE_PAIS_NACION : '', ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'nacionalidad_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm ">Ciudad Nacimiento :
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('ciudad', isset($data['persona']->PE_CIUD_NACION) ? $data['persona']->PE_CIUD_NACION : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Ciudad ', 'required', 'id' => 'ciudad_id']) !!}
                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Fecha Nacimiento</label><br>
                                <div class="input-group">
                                    {!! Form::text('fec_naci', isset($data['persona']->PE_FECHA_NAC) ? $data['persona']->getFechaNacimiento() : '', ['class' => 'form-control form-control-sm daterangepick', 'id' => 'fec_naci_id']) !!}
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar" style="color: green"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">País emisor del documento :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('paisDocumento', $data['paises_eleccion'], isset($data['persona']->PE_PAIS_DOCU) ? $data['persona']->PE_PAIS_DOCU : '', ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'pais_docu_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Tipo de Documento :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('tipodocumento', $data['tiposdocumento'], isset($data['persona']->PE_TIPO_DOCU) ? $data['persona']->PE_TIPO_DOCU : '', ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'tipo_docu_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Número de Documento :
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('numdocumento', isset($data['persona']->PE_NUM_DOCU) ? $data['persona']->PE_NUM_DOCU : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Numero de Documento', 'required', 'id' => 'nume_docu_id']) !!}
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Email :
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('email', isset($data['persona']->PE_CORREO) ? $data['persona']->PE_CORREO : $data['user']->email, ['class' => 'form-control form-control-sm', 'placeholder' => 'Numero de Documento', 'disabled', 'id' => 'nume_docu_id']) !!}

                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Sexo :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('sexo', $data['sexo'], isset($data['persona']->PE_SEXO) ? $data['persona']->PE_SEXO : '', ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'sexo_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Estado Civil :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('estadocivil', $data['estados_civiles'], isset($data['persona']->PE_ESTADO_CIV) ? $data['persona']->PE_ESTADO_CIV : '', ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'estado_civil_id']) !!}
                                </div>
                            </div>
                        </div>
                        <span style="font-weight: bold;"><i class="fas fa-address-book text-success"
                                style="padding-right: 7px;"> </i> DATOS DE CONTACTO </span>
                        <hr class="mt-2 mb-2">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Numero Celular :
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('celular', isset($data['persona']->PE_NUM_CEL) ? $data['persona']->PE_NUM_CEL : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Numero de Celular', 'id' => 'celular_id']) !!}

                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">LinkedIn :
                                        <span>(Opcional)</span>
                                    </label>
                                    {!! Form::text('linkedin', isset($data['persona']->PE_LINKEDIN) ? $data['persona']->PE_LINKEDIN : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Pagina de Linkedin', 'id' => 'linkedin_id']) !!}

                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Perfil Profesional</label><br>
                                {!! Form::textarea('perfil', isset($data['persona']->PE_PERFIL) ? $data['persona']->PE_PERFIL : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese descripción de su perfil profesional', 'id' => 'perfil_id', 'rows' => '3']) !!}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <br>
            <div class="d-flex justify-content-between">

                <div class="form-group col-md-2">
                    <a type="button" href="{{ route('home') }}" class="btn btn-secondary btn-block">Volver</a>
                </div>
                <div class="form-group col-md-2">
                    {{-- <span class="badge" id="txt_guardado_id"></span> --}}
                    <button type="button" class="btn btn-success btn-block" id="btn_guardar">Guardar</button>
                </div>
                <div class="form-group col-md-2">
                    <a href="{{ route('formulario.datos_generales.prueba') }}" type="button"
                        class="btn btn-primary btn-block">Siguiente</a>
                </div>

            </div>
            {!! Form::close() !!}
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('scripts')
    {{-- select2 --}}
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- filestyle --}}
    <script src="{{ asset('adminlte/plugins/bootstrap-filestyle/bootstrap-filestyle.min.js') }}"></script>


    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/locale/es.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    {{-- jquery-confirm --}}
    <script src="{{ asset('adminlte/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    {{-- js --}}
    <script src="{{ asset('adminlte/dist/js/PerfilCurricular/datos_generales/datos_generales.js') }}"></script>
@endsection
