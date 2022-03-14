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

            <div class="card-deck">
                <div class="card card-success card-outline">

                    <div class="card-header text-center">
                        <h5 class="card-title text-green m-0">DATOS DE PERSONALES</h5>
                    </div>
                    <div class="card-body pb-0 pt-1">


                        <small class="form-text text-muted"> (*) Campos Obligatorios</small> <br>
                        {!! Form::open(['route' => ['formulario.datos_generales.guardar'], 'id' => 'modal_form_guardar']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" name="persona_codigo" id="persona_codigo_id"
                            value="{{ $data['persona']->PE_CODIGO }}">
                        <div class="form-row">
                            <div class="form-group col-md">

                                <label class="col-form-label col-form-label-sm ">Apellido Paterno:
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('apellidopater', isset($data['persona']->PE_APELLIDO_P) ? $data['persona']->PE_APELLIDO_P : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Apellido paterno', 'oninput' => 'fn_guardar()', 'required', 'id' => 'apellidop_id']) !!}

                            </div>
                            <div class="form-group col-md">

                                <label class="col-form-label col-form-label-sm ">Apellido Materno:
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('apellidomater', isset($data['persona']->PE_APELLIDO_M) ? $data['persona']->PE_APELLIDO_M : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Apellido materno', 'oninput' => 'fn_guardar()', 'required', 'id' => 'apellidom_id']) !!}
                            </div>
                            <div class="form-group col-md">

                                <label class="col-form-label col-form-label-sm ">Nombres:
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('nombre', isset($data['persona']->PE_NOMBRES) ? $data['persona']->PE_NOMBRES : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Ingrese nombres', 'oninput' => 'fn_guardar()', 'required', 'id' => 'nombre_id']) !!}

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Indique cual es su Nacionalidad :(Pais
                                        de Origen)
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('paisNacimiento', $data['paises_eleccion'], isset($data['persona']->PE_PAIS_NACION) ? $data['persona']->PE_PAIS_NACION : '', ['class' => 'form-control select2', 'required','onchange' => 'fn_guardar()', 'style' => 'width:100%', 'id' => 'nacionalidad_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm ">Ciudad de Nacimiento :
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('ciudad', isset($data['persona']->PE_CIUD_NACION) ? $data['persona']->PE_CIUD_NACION : '', ['class' => 'form-control form-control-sm input_mayus', 'placeholder' => 'Ciudad ','oninput' => 'fn_guardar()', 'required', 'id' => 'ciudad_id']) !!}
                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Fecha de Nacimiento</label><br>
                                <div class="input-group">
                                    {!! Form::text('fec_naci', isset($data['persona']->PE_FNACIMIENTO) ? $data['persona']->getFechaNacimiento() : '', ['class' => 'form-control form-control-sm daterangepick','oninput' => 'fn_guardar()', 'id' => 'fec_naci_id']) !!}
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
                                    <label class="col-form-label col-form-label-sm">Indique el País emisor del documento :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('paisDocumento', $data['paises_eleccion'], isset($data['persona']->PE_PAIS_DOCU) ? $data['persona']->PE_PAIS_DOCU : '', ['class' => 'form-control select2', 'required','onchange' => 'fn_guardar()', 'style' => 'width:100%', 'id' => 'pais_docu_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Tipo de Documento de identidad :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('tipodocumento', $data['tiposdocumento'], isset($data['persona']->PE_TIPO_DOC) ? $data['persona']->PE_TIPO_DOC : '', ['class' => 'form-control select2', 'required','onchange' => 'fn_guardar()', 'style' => 'width:100%', 'id' => 'tipo_docu_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Número de Documento :
                                    <span style="color:red">(*)</span>
                                </label>
                                {!! Form::text('numdocumento', $data['persona']->PE_DOCUMENTO, ['class' => 'form-control form-control-sm', 'placeholder' => 'Numero de Documento', 'required','oninput' => 'fn_guardar()', 'id' => 'nume_docu_id']) !!}
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
                                    {!! Form::select('sexo', $data['sexo'], isset($data['persona']->PE_SEXO) ? $data['persona']->PE_SEXO : '', ['class' => 'form-control select2', 'required','onchange' => 'fn_guardar()', 'style' => 'width:100%', 'id' => 'sexo_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Estado Civil :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::select('estadocivil', $data['estados_civiles'], isset($data['persona']->PE_ESTADO_CIVIL) ? $data['persona']->PE_ESTADO_CIVIL : '', ['class' => 'form-control select2', 'required','onchange' => 'fn_guardar()', 'style' => 'width:100%', 'id' => 'estado_civil_id']) !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">

                            <div class="form-group col-md-2">
                                <a type="button" href="{{ route('home') }}" class="btn btn-secondary btn-block">Volver</a>
                            </div>
                            <div class="form-group">
                                <span class="badge" id="txt_guardado_id"></span>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="button" class="btn btn-primary btn-block"
                                    id="btn_siguiente_guardar">Siguiente</button>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                {{-- <div class="card card-success card-outline">

                    <div class="card-header text-center">
                        <h5 class="card-title text-green m-0">DATOS ADICIONALES</h5>
                    </div>
                    <div class="card-body pb-0 pt-1">

                        <input type="hidden" name="sesion" id="sesion" value="{{ $persona->PE_CODIGO }}">
                        <input type="hidden" name="progreso_info" id="progreso_info_id">

                        <small class="form-text text-muted"> (*) Campos Obligatorios</small> <br>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">RUC (Obligatorio para la suscripcion del
                                        contrato) :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::text('ruc', isset($pers->PE_RUC) ? $pers->PE_RUC : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Numero de RUC', 'required', 'id' => 'ruc_id']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md ">
                                <label class="col-form-label col-form-label-sm">Persona con discapacidad :
                                    <span style="color:red">(*)</span>
                                </label>
                                <br>
                                <div class="icheck-warning icheck-inline">
                                    {!! Form::radio('discapacidad', 0, $pers->PE_DISCAPACIDAD == 0 ? true : false, ['id' => 'no_dis_id']) !!}
                                    {!! Form::label('no_dis_id', 'No', ['style' => 'font-size:.875rem']) !!}
                                </div>
                                <div class="icheck-success icheck-inline">
                                    {!! Form::radio('discapacidad', 1, $pers->PE_DISCAPACIDAD == 1 ? true : false, ['id' => 'si_dis_id']) !!}
                                    {!! Form::label('si_dis_id', 'Sí', ['style' => 'font-size:.875rem']) !!}
                                </div>
                            </div>
                        </div>

                        <div id="datos_discapacidad" style="display: none">
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label class="col-form-label col-form-label-sm">Describir discapacidad :
                                        <span style="color:red">(*)</span>
                                    </label>
                                    {!! Form::text('desc_discapacidad', isset($pers->PE_DISCAPACIDAD_DESCR) ? $pers->PE_DISCAPACIDAD_DESCR : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Descripcion', 'required', 'id' => 'desc_discapacidad_id']) !!}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <div class="input-group-sm">
                                        <label class="col-form-label col-form-label-sm">Inscripcion en CONADIS(Nro Res)
                                            <span style="color:red">(*)</span>
                                        </label>
                                        {!! Form::text('inscripcion_conadis', isset($pers->PE_DISC_CONADIS) ? $pers->PE_DISC_CONADIS : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Inscripcion', 'required', 'id' => 'inscripcion_conadis_id']) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="col-form-label col-form-label-sm">Folio
                                    </label>
                                    {!! Form::text('folio', isset($pers->PE_FOLIO_DISC) ? $pers->PE_FOLIO_DISC : '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Folio', 'id' => 'folio_id']) !!}

                                </div>
                            </div>

                        </div>


                    </div>
                </div> --}}
            </div>
        </div><!-- /.container-fluid -->
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
