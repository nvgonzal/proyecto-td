<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo') | Niru System</title>
    {!! Html::style('css/bootstrap.css') !!}
    @yield('css')
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}">Niru</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                @if(Auth::check())
                    @if(Auth::user()->CUE_TIPO == 'ambos' || Auth::user()->CUE_TIPO == 'cliente')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Gestion envios<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Ver envios activos</a></li>
                                <li><a href="{{URL::to('/cliente/verhistorial')}}">Ver Historial de envios</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{URL::to('cliente/envio/create')}}">Creacion de envios</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->CUE_TIPO == 'ambos' || Auth::user()->CUE_TIPO == 'transportista')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Ver envios<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{URL::to('transportista/envios')}}">Envios en mi area</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{URL::to('transportista/envios/taken')}}">Solicitudes de envio</a></li>
                            </ul>
                        </li>
                    @endif
                @endif

            </ul>
            <!--Busqueda-->
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Cuenta</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Gestion de cuenta <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::to('/edit')}}">Editar Informacion</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{URL::to('/logout')}}">Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{URL::to('/register')}}">Crear cuenta</a></li>
                    <li><a href="{{URL::to('/login')}}">Iniciar sesion</a></li>
                </ul>
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>


<div class="container">
    @include('flash::message')
</div>

@yield('contenido')


{!! Html::script('js/jquery-1.12.4.js') !!}
{!! Html::script('js/bootstrap.js') !!}
@yield('js')
</body>
</html>