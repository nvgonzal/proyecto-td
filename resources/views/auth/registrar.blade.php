@extends('master')

@section('titulo','Registro de cuenta')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Formulario de registro</h3>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            {!! Form::open(['class'=>'form-horizontal','route'=>'auth.register']) !!}
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::email('email',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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
                            <div class="form-group {{ $errors->has('rut') ? ' has-error' : '' }}">
                                {!! Form::label('rut','RUT',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('rut',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('rut'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('nombres') ? ' has-error' : '' }}">
                                {!! Form::label('nombres','Nombres',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('nombres',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('nombres'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                                {!! Form::label('apellido_paterno','Apellido Paterno',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('apellido_paterno',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('apellido_paterno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                                {!! Form::label('apellido_materno','Apellido Materno',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('apellido_materno',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('apellido_materno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('apellido_materno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                {!! Form::label('telefono','Telefono',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('telefono',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                                <label class="col-md-3">Tipo de cuenta</label>

                                <label class="radio-inline">
                                    {!! Form::radio('tipo','transportista') !!} Trasportista.
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('tipo','cliente') !!} Cliente.
                                </label>
                                <label class="radio-inline">
                                    {!! Form::radio('tipo','ambos') !!} Ambos.
                                </label>
                                @if ($errors->has('tipo'))
                                    <span class="help-block col-md-offset-3">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </fieldset>
                    </div>
                    <div class="panel-footer">
                        {!! Form::submit('Ingresar cuenta',['class'=>'btn btn-primary btn-lg btn-block']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! Html::script('js/jquery.Rut.min.js') !!}
    {!! Html::script('js/js formularios/form cuentas.js') !!}
@stop