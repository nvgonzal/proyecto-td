@extends('master')

@section('titulo','Envios asignados')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Envios asignados</h3>
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
                                <th>Finalizado</th>
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
                                            <a class="btn btn-warning btn-sm" data-toggle="tooltip"
                                               title="Editar informacion"
                                               href="{{URL::to('cliente/envio/edit/'.$envio->ENV_ID)}}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="boton-finalizar" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                               title="Marcar como finalizado"
                                               href="#">
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
            <div class="text-center"> {!! $envios->render() !!}</div>
        </div>
    </div>
@stop

@section('js')
    {{Html::script('js/tabla.js')}}
    <script type="text/javascript">
        $(function () {
            $('tr').on('click', '#boton-finalizar', function (event) {
                event.preventDefault();
                var id = $(this).closest('tr').data('id');
                var url = "{{URL::to('cliente/envio/finalizar')}}" + "/" + id;
                var botonAceptar = $('<a id="boton-confirmar" class="btn btn-primary btn-sm" data-toggle="tooltip" ' +
                        'title="Confirmar finalizacion" href="' + url + '"> <span class="glyphicon glyphicon-ok-circle" ' +
                        'aria-hidden="true"></span> </a>').tooltip();
                $(this).closest('td').append(botonAceptar);
                $(this).tooltip('hide');
                $(this).remove();
            });
        });
    </script>
@stop