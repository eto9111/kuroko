<!DOCTYPE html>
<html>
<head>
    <title>Kuroko no Basket</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<nav>
    <a href="/">Inicio</a>
    <a href="/menu">Personajes</a>
    <a href="/nosotros">Anime</a>
    <a href="/contacto">Fan Page</a>
    <a href="/capitulos">Capítulos</a>  
</nav>

<hr>

@yield('content')

</body>
</html>