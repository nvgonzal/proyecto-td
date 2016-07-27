@extends('master')

@section('titulo','Envios finalizados')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Historial de envios</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <th>Descripcion</th>
                                <th>Direccion de carga</th>
                                <th>Direccion de destino</th>
                                <th>Estado</th>
                                <th>Detalles</th>
                                <th>Evaluar</th>
                                </thead>
                                @foreach($envios as $envio)
                                    <tr data-id="{{$envio->ENV_ID}}">
                                        <td>{{$envio->ENV_DESCRIPCION}}</td>
                                        <td>{{$envio->ENV_DIRECCION_RECOGIDA}}</td>
                                        <td>{{$envio->ENV_DIRECCION_DESTINO}}</td>
                                        <td>{{$envio->ENV_ESTADO}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                               title="Informacion detallada"
                                               href="{{URL::to('cliente/envio/'.$envio->ENV_ID)}}">
                                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="boton-finalizar" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                               title="Evaluar"
                                               href="{{Request::path() == 'cliente/verhistorial/finalizados'
                                               ? URL::to('cliente/envio/'.$envio->ENV_ID.'/rate'):
                                               URL::to('transportista/envio/'.$envio->ENV_ID.'/rate')}}">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop