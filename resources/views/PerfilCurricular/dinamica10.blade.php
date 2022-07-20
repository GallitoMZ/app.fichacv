@extends('layouts.main')
@section('usuario')
    {{ $data['user']->name }}
@endsection
@section('styles')

    {{-- jquery-confirm --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-confirm/jquery-confirm.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user-edit text-warning nav-icon"></i> DINAMICA 10</h1>
                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {!! Form::open(['route' => ['formulario.dinamica_guardar'], 'id' => 'modal_form_guardar']) !!}
            <span class="badge badge-dark text-md">BD SISTEMA 1</span> <hr>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="formGroupExampleInput">Nombre</label>
                    <input type="text" name="data_S1" class="form-control" id="data_S1_id"
                        placeholder="Escribir informacion a bdsistema 1">
                </div>
                <div class="form-group col-md">
                    <label for="formGroupExampleInput">ABREV</label>
                    <input type="text" name="abrev_S1" class="form-control" id="abrev_S1_id"
                        placeholder="Escribir abrev a bdsistema 1">
                </div>
            </div>



            <br>
            <div class="d-flex justify-content-center">
                <div class="form-group">
                    <button type="button" class="btn btn-success btn-block" id="btn_guardar_info">Guardar Informacion</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection
@section('scripts')
    {{-- select2 --}}
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
      {{-- jquery-confirm --}}
      <script src="{{ asset('adminlte/plugins/jquery-confirm/jquery-confirm.min.js') }}"></script>
    {{-- js --}}
    <script src="{{ asset('adminlte/dist/js/PerfilCurricular/dinamicas/dinamica10.js') }}"></script>


@endsection
