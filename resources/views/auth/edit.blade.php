@extends('master')

@section('titulo','Editar Informacion')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar Informacion</h3>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                Informacion Personal</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse">

                                        <div class="panel-body">
                                            <fieldset>
                                                {!!
                                                Form::model($infoCuenta,['class'=>'form-horizontal','route'=>'auth.edit.per','method'=>'put'])
                                                !!}
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
                                                <div
                                                        class="form-group {{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                                                    {!! Form::label('apellido_paterno','Apellido Paterno',['class'=>'col-md-3'])
                                                    !!}
                                                    <div class="col-md-9">
                                                        {!! Form::text('apellido_paterno',null,['class'=>'form-control']) !!}
                                                        @if ($errors->has('apellido_paterno'))
                                                            <span class="help-block">
                                        <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div
                                                        class="form-group {{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                                                    {!! Form::label('apellido_materno','Apellido
                                                    Materno',['class'=>'col-md-3'])!!}
                                                    <div class="col-md-9">
                                                        {!! Form::text('apellido_materno',null,['class'=>'form-control']) !!}
                                                        @if ($errors->has('apellido_materno'))
                                                            <span class="help-block">
                                            <strong>{{ $errors->first('apellido_materno') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="panel-footer">
                                            {!! Form::submit('Guardar cambios',['class'=>'btn btn-success btn-lg
                                            btn-block']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                Cambio de contraseña</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            {!!
                                            Form::open(['class'=>'form-horizontal','route'=>'auth.edit.pass','method'=>'put'])
                                            !!}
                                            <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                                {!! Form::label('oldPassword','Contraseña Antigua',['class'=>'col-md-3'])
                                                !!}
                                                <div class="col-md-9">
                                                    {!! Form::password('oldPassword',['class'=>'form-control']) !!}
                                                    @if ($errors->has('oldPassword'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                {!! Form::label('password','Nueva Contraseña',['class'=>'col-md-3']) !!}
                                                <div class="col-md-9">
                                                    {!! Form::password('password',['class'=>'form-control']) !!}
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div
                                                    class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                {!! Form::label('password_confirmation','Confirmar nueva
                                                contraseña',['class'=>'col-md-3']) !!}
                                                <div class="col-md-9">
                                                    {!! Form::password('password_confirmation',['class'=>'form-control'])
                                                    !!}
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                {!! Form::submit('Cambiar contraseña',['class'=>'btn btn-success btn-lg
                                                btn-block']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                Informacion de cuenta</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            {!!
                                            Form::model($infoCuenta,['class'=>'form-horizontal','route'=>'auth.edit.cue','method'=>'put'])
                                            !!}

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
                                            <div class="panel-footer">
                                                {!! Form::submit('Guardar cambios',['class'=>'btn btn-success btn-lg
                                                btn-block']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                Borrar cuenta</a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p class="help-block text-warning">
                                                Esta accion eliminara la cuenta con toda su informacion asociada.
                                                Los envios sin embargo permaneceran guardados
                                            </p>
                                            <a href="{{URL::to('logout/delete')}}">
                                                <button class="btn btn-primary btn-block">Borrar cuenta</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                                Actualizar foto de perfil</a>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            {!! Form::open(['route'=>'auth.edit.img','method'=>'put','files'=>true]) !!}
                                            <div class="form-group {{ $errors->has('foto') ? ' has-error' : '' }}">
                                                {!! Form::label('foto','Foto de perfil',['class'=>'col-md-3']) !!}
                                                <div class="col-md-9">
                                                    {!! Form::file('foto') !!}
                                                    @if ($errors->has('foto'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            {!! Form::submit('Guardar cambios',['class'=>'btn btn-success btn-lg
                                            btn-block']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop