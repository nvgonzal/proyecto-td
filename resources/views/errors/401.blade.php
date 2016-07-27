@extends('error')

@section('titulo','401 | No autorizado')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        401</h2>
                    <div class="error-details">
                        ¡No tienes permisos para realizar esta accion!
                    </div>
                    <div class="error-actions">
                        <a href="{{URL::to('/')}}" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-home"></span>
                            Volver a inicio </a>
                        <a href="{{URL::previous()}}" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-upload"></span>
                            Volver atras </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop