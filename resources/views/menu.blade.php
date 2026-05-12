@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Generación de los Milagros</h1>

        <div class="cards-grid">
            <div class="card">
                <h2>1. Seijuro Akashi</h2>
                <img src="https://static0.gamerantimages.com/wordpress/wp-content/uploads/2022/05/pjimage-(27)-2.jpg?w=1600&h=900&fit=crop"
                    width="200">
                <p><strong>Estatura:</strong> 1.73 m</p>
                <p><strong>Edad:</strong> 16–17 años</p>
                <p><strong>Posición:</strong> Base (Point Guard)</p>
                <p><strong>Escuela:</strong> Rakuzan High</p>
                <p><strong>Descripción:</strong> Capitán de la Generación de los Milagros. Tiene una mente estratégica impresionante y su habilidad Emperor Eye le permite anticipar los movimientos del rival.</p>
            </div>

            <div class="card">
                <h2>2. Ryota Kise</h2>
                <img src="{{ asset('https://i.pinimg.com/originals/6d/44/ea/6d44eaacb19e8c06d2ce70483cfc7d32.jpg') }}"
                    width="200">
                <p><strong>Estatura:</strong> 1.89 m</p>
                <p><strong>Edad:</strong> 16–17 años</p>
                <p><strong>Posición:</strong> Alero (Small Forward)</p>
                <p><strong>Escuela:</strong> Kaijo High</p>
                <p><strong>Descripción:</strong> Puede copiar cualquier técnica que vea (Perfect Copy). Es uno de los jugadores más versátiles.</p>
            </div>

            <div class="card">
                <h2>3. Daiki Aomine</h2>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT58DLyzeD78j8NnH_b3r2uZEcfmRSDzs-zDQ&s"
                    width="200">
                <p><strong>Estatura:</strong> 1.92 m</p>
                <p><strong>Edad:</strong> 16–17 años</p>
                <p><strong>Posición:</strong> Alero (Power Forward / Small Forward)</p>
                <p><strong>Escuela:</strong> Touou Academy</p>
                <p><strong>Descripción:</strong> Jugador extremadamente rápido y dominante. Su estilo es impredecible y difícil de defender.</p>
            </div>

            <div class="card">
                <h2>4. Atsushi Murasakibara</h2>
                <img src="{{ asset('https://static.wikia.nocookie.net/kurokonobasuke/images/f/fd/Atsushi_Murasakibara_HD.png/revision/latest?cb=20150116155808&path-prefix=es') }}"
                    width="200">
                <p><strong>Estatura:</strong> 2.08 m</p>
                <p><strong>Edad:</strong> 16–17 años</p>
                <p><strong>Posición:</strong> Pívot (Center)</p>
                <p><strong>Escuela:</strong> Yosen High</p>
                <p><strong>Descripción:</strong> El más alto y fuerte del grupo. Especialista en defensa y bloqueo.</p>
            </div>

            <div class="card">
                <h2>5. Shintaro Midorima</h2>
                <img src="{{ asset('https://static.wikia.nocookie.net/kurokonobasuke/images/3/3c/Midorima_serious.png/revision/latest?cb=20131027123036') }}"
                    width="200">
                <p><strong>Estatura:</strong> 1.95 m</p>
                <p><strong>Edad:</strong> 16–17 años</p>
                <p><strong>Posición:</strong> Escolta (Shooting Guard)</p>
                <p><strong>Escuela:</strong> Shutoku High</p>
                <p><strong>Descripción:</strong> Tirador perfecto. Puede encestar desde cualquier parte de la cancha con gran precisión.</p>
            </div>

            <div class="card">
                <h2>6. Tetsuya Kuroko (Jugador Fantasma)</h2>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6rq3Ecby56vj14ATnr_o5CbssvFBwEE5kkA&s"
                    width="200">
                <p><strong>Estatura:</strong> 1.68 m</p>
                <p><strong>Edad:</strong> 16–17 años</p>
                <p><strong>Posición:</strong> Base (Point Guard)</p>
                <p><strong>Escuela:</strong> Seirin High</p>
                <p><strong>Descripción:</strong> No destaca físicamente, pero su habilidad de pase y su invisibilidad en la cancha lo hacen único.</p>
            </div>
        </div>
    </div>
@endsection