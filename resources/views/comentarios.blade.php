@extends('layouts.layout')

@section('content')
<div class="container" style="padding: 20px;">
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
