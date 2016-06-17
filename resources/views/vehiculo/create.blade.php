@extends('master')

@section('titulo','Ingresar vehiculo')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3> Ingresar nuevo vehiculo </h3>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            {!! Form::open(['route'=>'vehiculo.create','method'=>'']) !!}
                            <div class="form-group {{ $errors->has('modelo') ? ' has-error' : '' }}">
                                {!! Form::label('modelo','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('modelo',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('modelo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('modelo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('marca') ? ' has-error' : '' }}">
                                {!! Form::label('marca','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('marca',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('marca'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('año') ? ' has-error' : '' }}">
                                {!! Form::label('año','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::number('año',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('año'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('año') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('patente') ? ' has-error' : '' }}">
                                {!! Form::label('patente','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('patente',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('patente'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('patente') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('capacidad') ? ' has-error' : '' }}">
                                {!! Form::label('capacidad','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::email('capacidad',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('capacidad'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('capacidad') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                {!! Form::label('descripcion','Correo electronico',['class'=>'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::textarea('descripcion',null,['class'=>'form-control']) !!}
                                    @if ($errors->has('descripcion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="panel-footer">
                        {!! Form::submit('Ingresar vehiculo') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop