<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h4>Saludos</h4>
    <p>Felicidades, el cliente <strong>{!! $Nombre !!}</strong> te ha asignado a su envio con identificador <strong>{!! $Id_Envio !!}</strong></p>
    <p>Ponte en contacto con él, por medio de su correo <strong>{!! $Correo !!}</strong> o su telefono <strong>{!! $Telefono !!}</strong></p>
    <p>Revisa su perfil haciendo <a href="http://localhost/proyecto_td/public/index.php/cuenta/info/{!! $Id_Cli !!}">click aqui</a></p>
</body>
</html>