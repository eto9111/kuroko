@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Temporadas y Película</h1>

        <div class="cards-grid">
            <div class="card" style="text-align: left; padding: 20px;">
                <h2>Temporada 1</h2>
                <p><strong>Episodios:</strong> 25</p>
                <p><strong>Emisión:</strong> 2012</p>
                <p><strong>Resumen:</strong> Introducción del equipo Seirin y primeros enfrentamientos contra Kaijo y Shutoku. Se presenta la Generación de los Milagros.</p>
            </div>

            <div class="card" style="text-align: left; padding: 20px;">
                <h2>Temporada 2</h2>
                <p><strong>Episodios:</strong> 25</p>
                <p><strong>Emisión:</strong> 2013</p>
                <p><strong>Resumen:</strong> Seirin enfrenta a Touou Academy. Aparece el concepto de la Zona y se profundiza en el pasado de los jugadores.</p>
            </div>

            <div class="card" style="text-align: left; padding: 20px;">
                <h2>Temporada 3</h2>
                <p><strong>Episodios:</strong> 25</p>
                <p><strong>Emisión:</strong> 2015</p>
                <p><strong>Resumen:</strong> Desarrollo del torneo Winter Cup y enfrentamientos finales contra Yosen y Rakuzan.</p>
            </div>

            <div class="card" style="text-align: left; padding: 20px;">
                <h2>Película: Kuroko no Basket The Movie Last Game</h2>
                <p><strong>Año:</strong> 2017</p>
                <p><strong>Resumen:</strong> El equipo Jabberwock desafía a Japón, lo que lleva a la formación de Vorpal Swords con todos los miembros de la Generación de los Milagros y Kagami.</p>
            </div>
        </div>

    <hr style="margin-top: 30px; margin-bottom: 30px;">

    <h2>Reseñas de la Comunidad</h2>

    @auth
        <div class="card" style="padding: 20px; background-color: #f9f9f9; margin-bottom: 20px;">
            <h3>Deja tu reseña</h3>
            
            @if(session('success_resena'))
                <div style="color: green; margin-bottom: 15px;">
                    {{ session('success_resena') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/resenas') }}">
                @csrf
                <textarea name="contenido" rows="3" style="width: 100%; margin-bottom: 10px;" placeholder="¿Qué te parecieron los capítulos y temporadas?" required></textarea><br>
                <button type="submit" style="background-color: #ffaa00; padding: 10px 15px; border: none; cursor: pointer; color: white;">Publicar Reseña</button>
            </form>
        </div>
    @else
        <p><em><a href="/login" style="color: #ffaa00;">Inicia sesión</a> o <a href="/register" style="color: #ffaa00;">Regístrate</a> para dejar tu propia reseña.</em></p>
    @endauth

    @if(isset($resenas) && $resenas->count() > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2; color: #333;">
                    <th>Usuario</th>
                    <th>Correo (Gmail)</th>
                    <th>Reseña</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resenas as $resena)
                <tr>
                    <td>{{ $resena->user->name ?? 'Anónimo' }}</td>
                    <td>{{ $resena->user->email ?? 'N/A' }}</td>
                    <td>{{ $resena->contenido }}</td>
                    <td>{{ $resena->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aún no hay reseñas. ¡Sé el primero en opinar!</p>
    @endif

</div>
@endsection