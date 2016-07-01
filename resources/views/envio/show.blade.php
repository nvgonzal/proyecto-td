@extends('master')

@section('titulo','Detalles de envio')

@section('css')
    {!! Html::style('css/tabla.css') !!}
@stop

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                {!! $map['html'] !!}
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>Detalles del envio</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-12">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Descipcion</td>
                                        <td>{{ $envio->ENV_DESCRIPCION }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $envio->ENV_ID }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tipo de envio</td>
                                        <td>{{ $envio->ENV_TIPO }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tipo de camion requerido</td>
                                        <td>{{ $envio->ENV_TIPO_CAMION }}</td>
                                    </tr>
                                    <tr>
                                        <td>Direccion recogida</td>
                                        <td>{{ $envio->ENV_DIRECCION_RECOGIDA }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha limite</td>
                                        <td>{{ $envio->ENV_FECHA_LIMITE }}</td>
                                    </tr>
                                    <tr>
                                        <td>Direccion destino</td>
                                        <td>{{ $envio->ENV_DIRECCION_DESTINO }}</td>
                                    </tr>
                                    <tr>
                                        <td>Coordenadas de recogida</td>
                                        <td>{{ $envio->ENV_COORDENADAS_RECOGIDA }}</td>
                                    </tr>
                                    <tr>
                                        <td>Coordenadas de destino</td>
                                        <td>{{ $envio->ENV_COORDENADAS_DESTINO}}</td>
                                    </tr>
                                    <tr>
                                        <td>Peso</td>
                                        <td>{{ $envio->ENV_PESO_CARGA}} kg</td>
                                    </tr>
                                    <tr>
                                        <td>Volumen</td>
                                        <td>{{ $envio->ENV_VOLUMEN}} </td>
                                    </tr>
                                    @if($envio->ENV_ESTADO == true)
                                        <tr class="success">
                                            <td>Estado</td>
                                            <td>Activo</td>
                                        </tr>
                                    @else
                                        <tr class="danger">
                                            <td>Estado</td>
                                            <td>Finalizado</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! $map['js'] !!}
    {!! Html::script('js/js crud/tabla.js') !!}
@stop