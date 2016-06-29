@extends('master')

@section('titulo','Envios disponibles')

@section('contenido')
    <div class="container">
        {!! $map['html'] !!}
    </div>
@stop

@section('js')
    {!! $map['js'] !!}
@stop