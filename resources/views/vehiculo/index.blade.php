@extends('master')

@section('css')
    {!! Html::style('css/estilos.css') !!}
@stop

@section('titulo','Mis vehiculos')

@section('contenido')

    <a class="btn btn-success boton-fixed btn-lg hidden-sm hidden-xs" data-toggle="tooltip" title="Agregar vehiculo"
       href="{!! URL::to('transportistas/mis-vehiculo/create') !!}">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </a>
    <a class="btn btn-success boton-fixed btn-sm hidden-lg hidden-md" data-toggle="tooltip" title="Agregar vehiculo"
       href="{!! URL::to('trasportistas/mis-vehiculo/create') !!}">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </a>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Año</th>
                <th>Patente</th>
                <th>Acciones</th>
                </thead>
                @foreach($vehiculos as $vehiculo)
                    <tr data-id="{{$vehiculo->CUE_ID}}">
                        <td>{{$vehiculo->VEH_MODELO}}</td>
                        <td>{{$vehiculo->VEH_MARCA}}</td>
                        <td>{{$vehiculo->VEH_ANIO}}</td>
                        <td>{{$vehiculo->VEH_PATENTE}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" title="Informacion detallada"
                               href="{{ URL::to('transportista/mis-vehiculo/'.$vehiculo->CUE_ID) }}">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </a>
                            <a class="btn btn-warning btn-sm" data-toggle="tooltip" title="Editar informacion"
                               href="{{ URL::to('transportista/vehiculo/'.$vehiculo->CUE_ID.'/edit') }}">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="text-center"> {!! $vehiculos->render() !!}</div>
@stop