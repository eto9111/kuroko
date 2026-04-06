@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Fan Page de Kuroko no Basket</h1>

    <p>Únete a la comunidad y comparte tu pasión por el anime.</p>



    @if(session('success'))
        <div style="color: green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/contacto">
        @csrf
        <label>Nombre:</label><br>
        <input type="text" name="nombre" placeholder="Tu nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" placeholder="Tu correo" required><br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad" required><br><br>

        <label>Personaje favorito:</label><br>
        <input type="text" name="personaje_favorito" required><br><br>

        <label>Equipo favorito:</label><br>
        <select name="equipo_favorito" required>
            <option value="Seirin High School">Seirin High School</option>
            <option value="Kaijo High School">Kaijo High School</option>
            <option value="Touou Academy">Touou Academy</option>
            <option value="Yosen High School">Yosen High School</option>
            <option value="Shutoku High School">Shutoku High School</option>
            <option value="Rakuzan High School">Rakuzan High School</option>
        </select><br><br>

        <label>¿Por qué te gusta el anime?</label><br>
        <textarea name="motivo" rows="4" cols="40" required></textarea><br><br>

        <button type="submit">Enviar</button>
    </form>

    <hr>
    
    <h2>Tabla de Fans Registrados</h2>
    @if(isset($fans) && $fans->count() > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2; color: #333;">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Edad</th>
                    <th>Personaje</th>
                    <th>Equipo</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fans as $fan)
                <tr>
                    <td>{{ $fan->id }}</td>
                    <td>{{ $fan->nombre }}</td>
                    <td>{{ $fan->correo }}</td>
                    <td>{{ $fan->edad }}</td>
                    <td>{{ $fan->personaje_favorito }}</td>
                    <td>{{ $fan->equipo_favorito }}</td>
                    <td>{{ $fan->motivo }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aún no hay fans registrados en la base de datos.</p>
    @endif

</div>
@endsection