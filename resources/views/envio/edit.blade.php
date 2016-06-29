@extends('master')

@section('titulo','Editar envio')

@section('css')
    {!! Html::style('css/bootstrap-datepicker3.css') !!}

@stop

@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3> Editar envio</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['
                        route'=> 'envio.edit',
                        'method'=>'post',
                        'class'=>'form-horizontal']) !!}
                        {!! Form::hidden('coor_envio') !!}
                        {!! Form::hidden('coor_destino') !!}
                        <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            {!! Form::label('descripcion','Descripcion',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::textarea('descripcion',$envio->ENV_DESCRIPCION,['class'=>'form-control']) !!}
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
                                {!! Form::text('tipo',$envio->ENV_TIPO,['class'=>'form-control']) !!}
                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('direccion_recogida') ? ' has-error' : '' }}">
                            {!! Form::label('direccion_recogida','Direccion carga',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                <input id="direccion_recogida" name="direccion_recogida" class="form-control"
                                       type="text" value="{{$envio->ENV_DIRECCION_RECOGIDA}}">

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
                            {!! Form::label('direccion_destino','Direccion de destino',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                <input id="direccion_destino" name="direccion_destino" class="form-control"
                                       type="text" value="{{$envio->ENV_DIRECCION_DESTINO}}">

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
                            {!! Form::label('fecha_limite','Fecha limite de entrega',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('fecha_limite',$envio->ENV_FECHA_LIMITE,['class'=>'form-control datepicker','readonly']) !!}
                                @if ($errors->has('fecha_limite'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_limite') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('peso') ? ' has-error' : '' }}">
                            {!! Form::label('peso','Peso (en kilos)',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('peso',$envio->ENV_PESO_CARGA,['class'=>'form-control']) !!}
                                @if ($errors->has('peso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('peso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('volumen') ? ' has-error' : '' }}">
                            {!! Form::label('volumen','Volumen (en metros cubicos)',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('volumen',$envio->ENV_VOLUMEN,['class'=>'form-control']) !!}
                                @if ($errors->has('volumen'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('volumen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('tipo_camion') ? ' has-error' : '' }}">
                            {!! Form::label('tipo_camion','Tipo de camion que necesitas',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('tipo_camion',$envio->ENV_TIPO_CAMION,['class'=>'form-control']) !!}
                                @if ($errors->has('tipo_camion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_camion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {!! Form::submit('Editar envio',['class'=>'btn btn-success btn-block btn-lg']) !!}
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