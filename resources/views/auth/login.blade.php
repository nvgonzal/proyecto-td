@extends('master')

@section('titulo','Inicio de sesion')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingresa tus datos</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route'=>'auth.login','method'=>'post']) !!}
                        <fieldset>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'E-mail']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox {{ $errors->has('remember') ? ' has-error' : '' }}">
                                <label>
                                    {!! Form::checkbox('remember','Mantener sesión') !!} Mantener sesión
                                </label>
                            </div>
                            {!! Form::submit('Iniciar sesion',['class'=>'btn btn-lg btn-success btn-block']) !!}
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop