@extends('master')

@section('titulo','Solicitudes del envio')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Solicitudes para el envio</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>RUT</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Aceptar</th>
                                </thead>
                                @foreach($envio->solicitudes as $solicitud)
                                    <tr>
                                        <td>{{$solicitud->cuenta->CUE_NOMBRES}}</td>
                                        <td>{{$solicitud->cuenta->CUE_APELL_PATERNO}}</td>
                                        <td>{{$solicitud->cuenta->CUE_APELL_MATERNO}}</td>
                                        <td>{{$solicitud->cuenta->CUE_RUT}}</td>
                                        <td>{{$solicitud->cuenta->CUE_TELEFONO}}</td>
                                        <td>{{$solicitud->cuenta->CUE_EMAIL}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                               title="Perfil del transportista"
                                               href="#">
                                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="boton-aceptar" class="btn btn-success btn-sm" data-toggle="tooltip"
                                               title="Acpetar solicitud"
                                               href="{{URL::to('cliente/envio/solicitudes/'.$id.'/acep/'.$solicitud->TRA_ID)}}">
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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