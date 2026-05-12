@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 600px; margin: 0 auto;">
    <div class="card" style="text-align: left;">
        
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://static.vecteezy.com/system/resources/previews/007/033/146/non_2x/profile-icon-login-head-icon-vector.jpg" alt="Profile Icon" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #60A5FA; margin-bottom: 10px;">
            <h2>Bienvenido a tu Dashboard, {{ Auth::user()->name }}!</h2>
            <p>Únete a la comunidad y comparte tu pasión por el anime.</p>
        </div>

        @if(session('success'))
            <div style="color: green; margin-bottom: 20px; text-align: center; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/dashboard') }}">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Nombre:</label>
                <input type="text" name="nombre" placeholder="Tu nombre" required value="{{ Auth::user()->name }}" style="width: 100%; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Correo:</label>
                <input type="email" name="correo" placeholder="Tu correo" required value="{{ Auth::user()->email }}" style="width: 100%; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Edad:</label>
                <input type="number" name="edad" required style="width: 100%; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Personaje favorito:</label>
                <input type="text" name="personaje_favorito" required style="width: 100%; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Equipo favorito:</label>
                <select name="equipo_favorito" required style="width: 100%; box-sizing: border-box;">
                    <option value="Seirin High School">Seirin High School</option>
                    <option value="Kaijo High School">Kaijo High School</option>
                    <option value="Touou Academy">Touou Academy</option>
                    <option value="Yosen High School">Yosen High School</option>
                    <option value="Shutoku High School">Shutoku High School</option>
                    <option value="Rakuzan High School">Rakuzan High School</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Comenta</label>
                <textarea name="motivo" rows="8" required style="width: 100%; box-sizing: border-box; resize: vertical;"></textarea>
            </div>

            <div style="text-align: center;">
                <button type="submit" style="width: 100%;">Enviar Respuestas</button>
            </div>
        </form>
    </div>
</div>
@endsection
