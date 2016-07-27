@extends('master')

@section('titulo',$cuenta->CUE_NOMBRE_COMPLETO)

@section('css')
    <style type="text/css">
        .user-row {
            margin-bottom: 14px;
        }

        .user-row:last-child {
            margin-bottom: 0;
        }

        .dropdown-user {
            margin: 13px 0;
            padding: 5px;
            height: 100%;
        }

        .dropdown-user:hover {
            cursor: pointer;
        }

        .table-user-information > tbody > tr {
            border-top: 1px solid rgb(221, 221, 221);
        }

        .table-user-information > tbody > tr:first-child {
            border-top: 0;
        }

        .table-user-information > tbody > tr > td {
            border-top: 0;
        }

        .toppad {
            margin-top: 20px;
        }
    </style>
@stop

@section('contenido')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{$cuenta->CUE_NOMBRE_COMPLETO}}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center">
                        <img alt="Foto de perfil"
                             src="{{is_null($cuenta->CUE_FOTO_PERFIL) ?  URL::asset('img/pp/default.png') :
                             URL::asset('img/pp/'.$cuenta->CUE_FOTO_PERFIL)}}"
                             class="img-circle img-responsive">
                    </div>

                    <div class="col-xs-10 col-sm-10 hidden-md hidden-lg"><br>
                        <dl>
                            <dt>NOMBRE COMPLETO</dt>
                            <dd>{{$cuenta->CUE_NOMBRE_COMPLETO}}</dd>
                        </dl>
                    </div>
                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>RUT</td>
                                <td>{{$cuenta->CUE_RUT}}</td>
                            </tr>
                            <tr>
                                <td>Telefono</td>
                                <td>{{$cuenta->CUE_TELEFONO}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><a href="mailto:{{$cuenta->CUE_EMAIL}}">{{$cuenta->CUE_EMAIL}}</a></td>
                            </tr>
                            @if($cuenta->cliente != null)
                                <tr>
                                    <td>Calificacion como cliente</td>
                                    <td>{{$cuenta->cliente->CLI_VALORACION}}</td>
                                </tr>
                                @if($cuenta->cliente->empresa != null)
                                    <tr>
                                        <td>Empresa</td>
                                        <td><a href="{{URL::to('empresa/'.$cuenta->cliente->empresa->EMP_ID)}}">
                                                {{$cuenta->cliente->empresa->EMP_NOMBRE}}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            @if($cuenta->transportista != null)
                                <tr>
                                    <td>Calificacion como transportista</td>
                                    <td>{{$cuenta->transportista->TRA_VALORACION}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(Auth::check() && $cuenta->CUE_ID == Auth::user()->CUE_ID)
                <div class="panel-footer">
                    <div class="">
                        <a href="{{URL::to('edit')}}" data-original-title="Editar mi perfil" data-toggle="tooltip"
                           type="button"
                           class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">

    </script>
@stop