@extends('master')

@section('titulo','Detalles de envio')

@section('css')
    {!! Html::style('css/tabla.css') !!}
    {!! Html::style('css/estilos.css') !!}
@stop

@section('contenido')
    @if((Auth::user()->CUE_TIPO == 'ambos'
                        && \App\Cuenta::find(Auth::user()->CUE_ID)->cliente->CLI_ID != $envio->CLI_ID)||
                         Auth::user()->CUE_TIPO == 'transportista')
        @if(!$envio->solicitudes->contains('TRA_ID',App\Cuenta::find(Auth::user()->CUE_ID)->transportista->TRA_ID))
            <a class="btn btn-success btn-lg boton-fixed" data-toggle="tooltip"
               title="Tomar envio" data-placement="right"
               href="{{URL::to('transportista/envios/reg/'.$envio->ENV_ID)}}">
                <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
            </a>
        @else
            <a class="btn btn-primary btn-lg boton-fixed" data-toggle="tooltip"
               title="Cancelar solicitud" data-placement="right"
               href="{{URL::to('transportista/envios/undo/'.$envio->ENV_ID)}}">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
        @endif
    @endif
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
                    @if(App\Cuenta::find(Auth::user()->CUE_ID)->cliente != null
                    && App\Cuenta::find(Auth::user()->CUE_ID)->cliente->CLI_ID == $envio->CLI_ID)
                        <div class="panel-footer">
                            <a class="btn btn-primary" data-toggle="tooltip"
                               title="Ver solicitudes"
                               href="{{URL::to('cliente/envio/solicitudes/'.$envio->ENV_ID)}}">
                                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! $map['js'] !!}
    {!! Html::script('js/js crud/tabla.js') !!}
@stop