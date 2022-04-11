@extends('layouts.main')
@section('usuario')
    {{ isset($data['persona']->PE_NOMBRES) ? $data['persona']->PE_NOMBRES : $data['user']->name }}
@endsection
@section('styles')
    {{-- datatables bootstrap4 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    {{-- datatables responsive bootstrap4 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    {{-- jquery-confirm --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-confirm/jquery-confirm.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-graduate text-yellow nav-icon"></i> Educación</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Perfil Curricular</a></li>
                        <li class="breadcrumb-item active">Educación</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card-deck">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                    href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                    aria-selected="true">Estudios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">Idiomas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                                    aria-selected="false">Intereses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                    href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings"
                                    aria-selected="false">Habilidades y Competencias</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                aria-labelledby="custom-tabs-four-home-tab">
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <span class="badge badge-light">Tabla de estudios</span>

                                    </div>
                                    <div class="form-group col-md">
                                        <button type="button" onclick="fn_agregar_estudio()"
                                            class="btn btn-sm bg-gradient-primary float-sm-right">
                                            <i class="fa fa-plus"></i>
                                            Agregar Estudio
                                        </button>
                                    </div>

                                </div>

                                <table id="tabla_estudios" class="table table-bordered table-sm">
                                    <thead style="background-color: #f1f2f9; color:#56688A;font-size:13px">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Formación</th>
                                            <th scope="col">Situación</th>
                                            <th scope="col">Profesión</th>
                                            <th scope="col">Centro Estudios</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">País</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data['estudios'] as $row)
                                            <tr>
                                                <td class="align-middle ">
                                                    {{ $i++ }}
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="font-weight-bold text-green text-left text-sm text-wrap text-uppercase">{{ $row->EST_FORMACION }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span class="badge text-wrap">
                                                        {{ $row->EST_SITUACION }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span class="badge text-uppercase text-wrap">
                                                        {{ $row->EST_PROFESION }} </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge text-wrap">{{ $row->EST_CENTRO_ESTU }}</span>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="badge badge-default">{{ $row->EST_ANIO_INICIO }} -
                                                        {{ $row->EST_ANIO_FIN }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="badge bg-gradient-success">{{ $row->EST_PAIS_ESTU }}</span>
                                                </td>

                                                <td class="align-middle text-center">

                                                    <button class="btn btn-sm btn-outline-danger" type="button"
                                                        data-toggle="tooltip" data-placement="auto" title="Eliminar"
                                                        id="btn_eliminar_estudio"
                                                        onclick="fn_eliminar_estudio('{{ $row->EST_CODIGO }}')"><i
                                                            class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <span class="badge badge-light">Tabla de Idiomas</span>

                                    </div>
                                    <div class="form-group col-md">
                                        <button type="button" onclick="fn_agregar_idioma()"
                                            class="btn btn-sm bg-gradient-primary float-sm-right">
                                            <i class="fa fa-plus"></i>
                                            Agregar Idioma
                                        </button>
                                    </div>

                                </div>

                                <table id="tabla_idiomas" class="table table-bordered table-sm">
                                    <thead style="background-color: #f1f2f9; color:#56688A;font-size:13px">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Idioma</th>
                                            <th scope="col">Nivel</th>
                                            <th scope="col">Centro Estudios</th>
                                            <th scope="col">Modalidad</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $j = 1;
                                        @endphp
                                        @foreach ($data['idiomas'] as $row)
                                            <tr>
                                                <td class="align-middle ">
                                                    {{ $j++ }}
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="font-weight-bold text-green text-left text-sm text-wrap text-uppercase">{{ $row->IDI_IDIOMA }}</span>
                                                </td>

                                                <td class="align-middle ">
                                                    <span class="badge text-uppercase text-wrap">
                                                        {{ $row->IDI_NIVEL }} </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge text-wrap">{{ $row->IDI_CENTRO }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="badge bg-gradient-success">{{ $row->IDI_MODALIDAD }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-outline-danger" type="button"
                                                        data-toggle="tooltip" data-placement="auto" title="Eliminar"
                                                        id="btn_eliminar_idioma"
                                                        onclick="fn_eliminar_idioma('{{ $row->IDI_CODIGO }}')"><i
                                                            class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-four-messages-tab">
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <span class="badge badge-light">Tabla de Intereses o Hobbies</span>

                                    </div>
                                    <div class="form-group col-md">
                                        <button type="button" onclick="fn_agregar_interes()"
                                            class="btn btn-sm bg-gradient-primary float-sm-right">
                                            <i class="fa fa-plus"></i>
                                            Agregar Interes
                                        </button>
                                    </div>

                                </div>

                                <table id="tabla_intereses" class="table table-bordered table-sm">
                                    <thead style="background-color: #f1f2f9; color:#56688A;font-size:13px">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Interes</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $k = 1;
                                        @endphp
                                        @foreach ($data['intereses'] as $row)
                                            <tr>
                                                <td class="align-middle ">
                                                    {{ $k++ }}
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="font-weight-bold text-green text-left text-sm text-wrap text-uppercase">{{ $row->INTE_TIPO }}</span>
                                                </td>

                                                <td class="align-middle ">
                                                    <span class="badge text-justify text-wrap">
                                                        {{ $row->INTE_DESCRIPCION }} </span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <button class="btn btn-sm btn-outline-danger" type="button"
                                                        data-toggle="tooltip" data-placement="auto" title="Eliminar"
                                                        id="btn_eliminar_interes"
                                                        onclick="fn_eliminar_interes('{{ $row->INTE_CODIGO }}')"><i
                                                            class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                aria-labelledby="custom-tabs-four-settings-tab">
                                En Construcción SWACV - ONLINE
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Agregar Estudio -->
    <div class="modal fade" id="modal-agregar-estudio">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(['route' => ['formulario.educacion.agregar_estudios'], 'id' => 'modal_form_agregar_estudio']) !!}
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title"><i class="fas fa-user-graduate text-warning"></i> &nbsp;Agregar Estudio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card-body pb-2 pt-2">
                        <input type="hidden" name="sesion" id="sesion" value="{{ $data['persona']->PE_CODIGO }}">
                        <div class="form-row">
                            <div class="form-group col-md ">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Formación Académica <span
                                            style="color:red">(*)</span></label>
                                    {!! Form::select('formacion', $data['nivel'], null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'formacion_id']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Situacion <span
                                            style="color:red">(*)</span></label>
                                    {!! Form::select('situacion', $data['situacion'], null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'situacion_id']) !!}
                                </div>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Carrera o Especialidad<span
                                        style="color:red">(*)</span></label><br>
                                {!! Form::text('carrera', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Carrera', 'required', 'id' => 'carrera_id']) !!}
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">País de Estudios<span
                                            style="color:red">(*)</span></label>
                                    {!! Form::select('pais', $data['paises'], null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'pais_id']) !!}
                                    <small class="form-text text-muted"><i class="fas fa-info-circle"></i> Ingrese País
                                        donde realizó sus
                                        estudios</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Centro de estudios <span
                                        style="color:red">(*)</span></label><br>
                                {!! Form::text('centro', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Centro de estudios', 'required', 'id' => 'centro_id']) !!}
                                <small class="form-text text-muted"><i class="fas fa-info-circle"></i>
                                    Centro o Institucion donde realizó el
                                    estudio</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Año de Inicio <span
                                        style="color:red">(*)</span></label><br>
                                {!! Form::text('estudio_anio_ini', null, ['class' => 'form-control form-control-sm ', 'placeholder' => 'Ingrese Año de inicio', 'id' => 'estudio_anio_ini_id']) !!}

                            </div>
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Año de Fin </label><br>
                                {!! Form::text('estudio_anio_fin', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese Año de Fin', 'id' => 'estudio_anio_fin_id']) !!}
                                <small class="form-text text-muted"><i class="fas fa-info-circle"></i>
                                    No rellenar si está en Curso</small>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {!! Form::open(['route' => ['formulario.educacion.eliminar_estudios'], 'id' => 'form-eliminar-estudio']) !!}
    <input type="hidden" name="estudio_id" id="estudio_id" />
    {!! Form::close() !!}

    <!-- Agregar Idioma -->
    <div class="modal fade" id="modal-agregar-idioma">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(['route' => ['formulario.educacion.agregar_idioma'], 'id' => 'modal_form_agregar_idioma']) !!}
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title"><i class="fas fa-user-graduate text-warning"></i> &nbsp;Agregar idioma
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card-body pb-2 pt-2">
                        <input type="hidden" name="sesion_idioma" id="sesion_idioma"
                            value="{{ $data['persona']->PE_CODIGO }}">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Nombre Idioma<span
                                        style="color:red">(*)</span></label><br>
                                {!! Form::text('idioma', null, ['class' => 'form-control form-control-sm text-uppercase', 'placeholder' => 'Nombre del idioma', 'required', 'id' => 'idioma_id']) !!}
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Nivel<span
                                            style="color:red">(*)</span></label>
                                    {!! Form::select('nivel_idioma', $data['nivel_idioma'], null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'id' => 'nivel_idioma_id']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Centro de estudios</label><br>
                                {!! Form::text('centro_idioma', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Centro de estudios', 'id' => 'centro_idioma_id']) !!}
                                <small class="form-text text-muted"><i class="fas fa-info-circle"></i> No rellenar si es
                                    Nativo</small>
                            </div>
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Modalidad<span
                                            style="color:red">(*)</span></label>
                                    {!! Form::select('modalidad_idioma', $data['modalidad_idioma'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'modalidad_idioma_id']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {!! Form::open(['route' => ['formulario.educacion.eliminar_idioma'], 'id' => 'form-eliminar-idioma']) !!}
    <input type="hidden" name="idioma_elim" id="idioma_elim_id" />
    {!! Form::close() !!}


    <!-- Agregar Interes -->
    <div class="modal fade" id="modal-agregar-interes">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(['route' => ['formulario.educacion.agregar_interes'], 'id' => 'modal_form_agregar_interes']) !!}
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title"><i class="fas fa-user-graduate text-warning"></i> &nbsp;Agregar interes
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card-body pb-2 pt-2">
                        <input type="hidden" name="sesion_interes" id="sesion_interes"
                            value="{{ $data['persona']->PE_CODIGO }}">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <div class="input-group-sm">
                                    <label class="col-form-label col-form-label-sm">Tipo de Interés<span
                                            style="color:red">(*)</span></label>
                                    {!! Form::select('tipo_interes', $data['tipo_intereses'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'tipo_interes_id']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="col-form-label col-form-label-sm">Breve Descripcion del interés</label><br>
                                {!! Form::textarea('descripcion_interes', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ingrese descripción ', 'id' => 'descripcion_interes_id', 'rows' => '3']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {!! Form::open(['route' => ['formulario.educacion.eliminar_interes'], 'id' => 'form-eliminar-interes']) !!}
    <input type="hidden" name="interes_elim" id="interes_elim_id" />
    {!! Form::close() !!}
@endsection
@section('scripts')
    {{-- select2 --}}
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    {{-- datatables --}}
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    {{-- jquery-confirm --}}
    <script src="{{ asset('adminlte/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    {{-- js --}}
    <script src="{{ asset('adminlte/dist/js/PerfilCurricular/educacion/educacion.js') }}"></script>
@endsection
