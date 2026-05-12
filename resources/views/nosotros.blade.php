@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Detalles de la Obra (Manga y Anime)</h1>

        <div class="cards-grid">
            <div class="card" style="text-align: left; padding: 20px;">
                <h2>Datos del manga</h2>
                <ul>
                    <li><strong>Autor:</strong> Tadatoshi Fujimaki</li>
                    <li><strong>Publicación:</strong> diciembre de 2008 – septiembre de 2014</li>
                    <li><strong>Revista:</strong> Weekly Shonen Jump</li>
                    <li><strong>Editorial:</strong> Shueisha</li>
                    <li><strong>Volúmenes:</strong> 30</li>
                </ul>
            </div>

            <div class="card" style="text-align: left; padding: 20px;">
                <h2>Datos del anime</h2>
                <ul>
                    <li><strong>Estudio de animación:</strong> Production I.G</li>
                    <li><strong>Primera emisión:</strong> abril de 2012</li>
                    <li><strong>Última emisión:</strong> junio de 2015 (temporada 3)</li>
                    <li><strong>Episodios totales:</strong> 75 (3 temporadas)</li>
                    <li><strong>Película:</strong> 2017</li>
                </ul>
            </div>

            <div class="card" style="text-align: left; padding: 20px; background-color: #ffe6e6;">
                <h2>Estado del anime</h2>
                <p><strong>Transmisión actual:</strong> Finalizado</p>
                <p>El anime no se encuentra en emisión actualmente, ya que su historia principal fue adaptada completamente,
                    incluyendo su película final.</p>
            </div>

            <div class="card"
                style="text-align: left; padding: 20px; background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba;">
                <h2 style="margin-top: 0; color: #856404;">Guía de Equipos y Jugadores</h2>
                <ul style="margin-bottom: 0;">
                    <li><strong>Seijuro Akashi:</strong> Escuela Rakuzan | Base | Capitán estratégico</li>
                    <li><strong>Ryota Kise:</strong> Escuela Kaijo | Alero | Copia perfecta</li>
                    <li><strong>Daiki Aomine:</strong> Academia Touou | Alero | Juego instintivo</li>
                    <li><strong>Atsushi Murasakibara:</strong> Escuela Yosen | Pívot | Defensa absoluta</li>
                    <li><strong>Shintaro Midorima:</strong> Escuela Shutoku | Escolta | Tiros largos</li>
                    <li><strong>Tetsuya Kuroko:</strong> Escuela Seirin | Base | Juego invisible y pases</li>
                </ul>
            </div>
        </div>
    </div>

@endsection