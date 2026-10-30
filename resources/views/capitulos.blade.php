@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Temporadas y Película</h1>

        @if(session('success'))
            <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                {{ session('error') }}
            </div>
        @endif

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

        @if(isset($capitulos) && $capitulos->count() > 0)
            <h2 style="margin-top: 40px; text-align: center;">Capítulos Adicionales</h2>
            <div class="cards-grid">
                @foreach($capitulos as $cap)
                    <div class="card" style="text-align: left; padding: 20px;">
                        <h2>Episodio {{ $cap->numero }}: {{ $cap->nombre }}</h2>
                        <p>{{ $cap->descripcion }}</p>
                        @if($cap->video_url)
                            <p><a href="{{ $cap->video_url }}" target="_blank" style="color: #2563eb; font-weight: bold;">Ver video →</a></p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
