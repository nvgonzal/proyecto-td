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
                                <th>RUT</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Asignar</th>
                                </thead>
                                @foreach($envio->solicitudes as $solicitud)
                                    <tr data-tra="{{$solicitud->TRA_ID}}">
                                        <td>{{$solicitud->cuenta->CUE_NOMBRE_COMPLETO}}</td>
                                        <td>{{$solicitud->cuenta->CUE_RUT}}</td>
                                        <td>{{$solicitud->cuenta->CUE_TELEFONO}}</td>
                                        <td>{{$solicitud->cuenta->CUE_EMAIL}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                               title="Perfil del transportista"
                                               href="{{URL::to('cuenta/info/'.$solicitud->cuenta->CUE_ID)}}">
                                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a id="boton-aceptar" class="btn btn-success btn-sm" data-toggle="tooltip"
                                               title="Asignar envio"
                                               href="#">
                                                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
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

@section('js')
    {{Html::script('js/tabla')}}
    <script type="text/javascript">
        $(function () {
            $('tr').on('click', '#boton-aceptar', function (event) {
                event.preventDefault();
                var id = $(this).closest('tr').data('tra');
                var url = "{{URL::to('cliente/envio/solicitudes/'.$id.'/acep/')}}" + "/" + id;
                var botonAceptar = $('<a id="boton-confirmar" class="btn btn-primary btn-sm" data-toggle="tooltip" ' +
                        'title="Confirmar asignacion" href="' + url + '"> <span class="glyphicon glyphicon-ok" ' +
                        'aria-hidden="true"></span> </a>').tooltip();
                $(this).closest('td').append(botonAceptar);
                $(this).tooltip('hide');
                $(this).remove();
            });
        });
    </script>
@stop