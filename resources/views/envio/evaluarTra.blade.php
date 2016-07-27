@extends('master')

@section('titulo','Evaluar transportista')

@section('css')
    {!! Html::style('css/tabla.css') !!}
@stop

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div align="center">
                                    <img alt="Foto de perfil"
                                         src="{{is_null($envio->transportista->cuenta->CUE_FOTO_PERFIL) ?  URL::asset('img/pp/default.png') :
                                         URL::asset('img/pp/'.$envio->transportista->cuenta->CUE_FOTO_PERFIL)}}"
                                         class="img-circle img-responsive">
                                </div>
                                <dl class="text-center">
                                    <dt>NOMBRE COMPLETO</dt>
                                    <dd>
                                        <a href="{{URL::to('cuenta/info/'.$envio->transportista->cuenta->CUE_ID)}}">
                                            {{$envio->transportista->cuenta->CUE_NOMBRE_COMPLETO}}
                                        </a>
                                    </dd>
                                    <dt>RUT</dt>
                                    <dd>{{$envio->transportista->cuenta->CUE_RUT}}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Descipcion</td>
                                            <td>{{ $envio->ENV_DESCRIPCION }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tipo de envio</td>
                                            <td>{{ $envio->ENV_TIPO }}</td>
                                        </tr>
                                        <tr>
                                            <td>Direccion recogida</td>
                                            <td>{{ $envio->ENV_DIRECCION_RECOGIDA }}</td>
                                        </tr>
                                        <tr>
                                            <td>Direccion destino</td>
                                            <td>{{ $envio->ENV_DIRECCION_DESTINO }}</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha limite</td>
                                            <td>{{ $envio->ENV_FECHA_LIMITE->format('j F Y') }}
                                                <i class="fa fa-calendar">
                                                    {{$envio->ENV_FECHA_LIMITE->diffForHumans()}}
                                                </i>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <h4>Evalua el trabajo del transportista</h4>
                                    {!! Form::open([
                                    'route'=>['envio.rate.tra',$envio->ENV_ID],
                                    'class'=>'form-inline',
                                    'method'=>'put'
                                    ])!!}
                                    <div class="form-group">
                                        {!! Form::label('evaluacion','Evaluacion del 1 al 5') !!}
                                        {!! Form::selectRange('evaluacion',
                                        1,5,$envio->ENV_VALORACION_TRA,['class'=>'form-control']) !!}
                                        {!! Form::submit('Evaluar',['class'=>'btn btn-default']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop