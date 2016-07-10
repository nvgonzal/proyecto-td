@extends('master')

@section('titulo','Envios tomados')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Solicitudes</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <th>Descripcion</th>
                                <th>Direccion de carga</th>
                                <th>Direccion de destino</th>
                                <th>Detalles</th>
                                <th>Cancelar</th>
                                </thead>
                                @foreach($envios as $envio)
                                    <tr data-id="{{$envio->ENV_ID}}">
                                        <td>{{$envio->ENV_DESCRIPCION}}</td>
                                        <td>{{$envio->ENV_DIRECCION_RECOGIDA}}</td>
                                        <td>{{$envio->ENV_DIRECCION_DESTINO}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                               title="Informacion detallada"
                                               href="{{URL::to('cliente/envio/'.$envio->ENV_ID)}}">
                                                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="boton-eliminar" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                               title="Cancelar solicitud"
                                               href="{{URL::to('transportista/envios/undo/'.$envio->ENV_ID)}}">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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