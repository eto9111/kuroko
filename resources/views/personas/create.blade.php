<!DOCTYPE html>
<html>
<head>
    <title>Formulario Personas</title>
</head>
<body>
    <h1>Registro</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="/personas">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre"><br>
        <input type="text" name="apellido" placeholder="Apellido"><br>
        <input type="number" name="edad" placeholder="Edad"><br>
        <input type="email" name="correo" placeholder="Correo"><br>
        <input type="text" name="celular" placeholder="Celular"><br>
        <input type="text" name="personaje_favorito" placeholder="Personaje favorito"><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
