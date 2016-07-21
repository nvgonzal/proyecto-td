@extends('error')

@section('titulo','404 | Pagina no encontrada')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        404</h2>
                    <div class="error-details">
                        ¡La pagina solicitada no se encontro!
                    </div>
                    <div class="error-actions">
                        <a href="{{URL::to('home')}}" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-home"></span>
                            Volver a inicio </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
