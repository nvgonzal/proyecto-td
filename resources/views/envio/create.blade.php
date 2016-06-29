@extends('master')

@section('titulo','Crear nuevo envio')

@section('css')
    {!! Html::style('css/bootstrap-datepicker3.css') !!}
    {!! Html::style('css/estilos.css') !!}

@stop

@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3> Crear nuevo envio</h3>
                    </div>
                    <div class="panel-body">
                        <p class="requerido"><i>Todos los campo son requeridos</i></p>
                        {!! Form::open(['route'=>'envio.store','method'=>'post','class'=>'form-horizontal']) !!}
                        <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            {!! Form::label('descripcion','Descripcion',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::textarea('descripcion',null,['class'=>'form-control','required']) !!}
                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                            {!! Form::label('tipo','Tipo de envio',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('tipo',null,['class'=>'form-control','required']) !!}
                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('direccion_recogida') ? ' has-error' : '' }}">
                            {!! Form::label('direccion_recogida','Direccion carga',['class'=>'col-md-3','required']) !!}
                            <div class="col-md-9">
                                <input id="direccion_recogida" name="direccion_recogida" class="form-control"
                                       type="text">

                                <div class="col-md-offset-9">
                                    {!! Html::image('img/powered_by_google_on_white.png') !!}
                                </div>
                                @if ($errors->has('direccion_recogida'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('direccion_recogida') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('direccion_destino') ? ' has-error' : '' }}">
                            {!! Form::label('direccion_destino','Direccion de destino',['class'=>'col-md-3','required']) !!}
                            <div class="col-md-9">
                                <input id="direccion_destino" name="direccion_destino" class="form-control" type="text">

                                <div class="col-md-offset-9">
                                    {!! Html::image('img/powered_by_google_on_white.png') !!}
                                </div>
                                @if ($errors->has('direccion_destino'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion_destino') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_limite') ? ' has-error' : '' }}">
                            {!! Form::label('fecha_limite','Fecha limite de entrega',['class'=>'col-md-3','required']) !!}
                            <div class="col-md-9">
                                {!! Form::text('fecha_limite',null,['class'=>'form-control datepicker','readonly']) !!}
                                @if ($errors->has('fecha_limite'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_limite') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('peso') ? ' has-error' : '' }}">
                            {!! Form::label('peso','Peso (en kilos)',['class'=>'col-md-3','required']) !!}
                            <div class="col-md-9">
                                {!! Form::text('peso',null,['class'=>'form-control']) !!}
                                @if ($errors->has('peso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('peso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('volumen') ? ' has-error' : '' }}">
                            {!! Form::label('volumen','Volumen (en metros cubicos)',['class'=>'col-md-3','required']) !!}
                            <div class="col-md-9">
                                {!! Form::text('volumen',null,['class'=>'form-control']) !!}
                                @if ($errors->has('volumen'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('volumen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('tipo_camion') ? ' has-error' : '' }}">
                            {!! Form::label('tipo_camion','Tipo de camion que necesitas',['class'=>'col-md-3','required']) !!}
                            <div class="col-md-9">
                                {!! Form::text('tipo_camion',null,['class'=>'form-control']) !!}
                                @if ($errors->has('tipo_camion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_camion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {!! Form::submit('Ingresar envio',['class'=>'btn btn-primary btn-block btn-lg']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('js')
    {!! Html::script('http://maps.google.com/maps/api/js?libraries=places&sensor=false') !!}
    {!! Html::script('js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('js/jquery.geocomplete.min.js') !!}
    {!! Html::script('js/js formularios/form envios.js') !!}
@stop