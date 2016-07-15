@extends('master')

@section('titulo','Resultados')

@section('contenido')
    <div class="container">
        @if($usuarios != null)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Resultado de la busqueda</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <th>Nombre</th>
                                    <th>RUT</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Perfil</th>
                                    </thead>
                                    @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>{{$usuario->CUE_NOMBRE_COMPLETO}}</td>
                                            <td>{{$usuario->CUE_RUT}}</td>
                                            <td>{{$usuario->CUE_TELEFONO}}</td>
                                            <td>{{$usuario->CUE_EMAIL}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                   title="Perfil del transportista"
                                                   href="{{URL::to('cuenta/info/'.$usuario->CUE_ID)}}">
                                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
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
        @else
            <div class="jumbotron">
                <h3>No has ingresado una busqueda!</h3>
                <p>Prueba escribiendo algo en el buscador</p>
            </div>
        @endif

    </div>
@stop