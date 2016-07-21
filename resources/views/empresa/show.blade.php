@extends('master')

@section('titulo',$empresa->EMP_NOMBRE)

@section('contenido')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{$empresa->EMP_NOMBRE}}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"><img alt="User Pic"
                                                                        src="{{$empresa->EMP_LINK_LOGO}}"
                                                                        class="img-circle img-responsive"></div>

                    <div class="col-xs-10 col-sm-10 hidden-md hidden-lg"><br>
                        <dl>
                            <dt>NOMBRE</dt>
                            <dd>{{$empresa->EMP_NOMBRE}}</dd>
                        </dl>
                    </div>
                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Direccion</td>
                                <td>{{$empresa->EMP_DIRECCION}}</td>
                            </tr>
                            <tr>
                                <td>Telefono</td>
                                <td>{{$empresa->EMP_TELEFONO}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop