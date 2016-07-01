@extends('master')

@section('titulo','Ver Historial')

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
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </thead>
                                @foreach($envios as $envio)
                                    <tr data-id="{{$envio->ENV_ID}}">
                                        <td>{{$envio->ENV_DESCRIPCION}}</td>
                                        <td>{{$envio->ENV_DIRECCION_RECOGIDA}}</td>
                                        <td>{{$envio->ENV_DIRECCION_DESTINO}}</td>
                                        @if($envio->ENV_ESTADO)
                                            <td>Activo</td>
                                        @else
                                            <td>Finalizado</td>
                                        @endif
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                               title="Informacion detallada"
                                               href="{{URL::to('cliente/envio/'.$envio->ENV_ID)}}">
                                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" data-toggle="tooltip"
                                               title="Editar informacion"
                                               href="{{URL::to('cliente/envio/edit/'.$envio->ENV_ID)}}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="boton-eliminar" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                               title="Eliminar empleado"
                                               href="#">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="text-center"> {!! $envios->render() !!}</div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(function () {
            $('tr').on('click', '#boton-eliminar', function (event) {
                event.preventDefault();
                var id = $(this).closest('tr').data('id');
                var url = 'http://localhost/proyecto_td/public/index.php/cliente/envio/delete/' + id;
                var botonAceptar = $('<a id="boton-confirmar" class="btn btn-primary btn-sm" data-toggle="tooltip" ' +
                        'title="Confirmar eliminacion" href="' + url + '"> <span class="glyphicon glyphicon-ok" ' +
                        'aria-hidden="true"></span> </a>').tooltip();
                $(this).closest('td').append(botonAceptar);
                $(this).tooltip('hide');
                $(this).remove();
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop