@extends('master')

@section('titulo','Eliminar cuenta')

@section('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Eliminar cuenta</div>
                <div class="panel-body">
                    {!! Form::open(['route'=>'auth.logout.delete','method'=>'post','class'=>'form-horizontal']) !!}

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password','Contraseña',['class'=>'col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::password('password',['class'=>'form-control']) !!}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password_confirmation','Confirmar contraseña',['class'=>'col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="panel-footer">
                        {!! Form::submit('Eliminar cuenta',['class'=>'btn btn-primary btn-lg btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop