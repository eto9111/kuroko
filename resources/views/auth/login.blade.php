@extends('layouts.layout')

@push('styles')
<style>
    .auth-bg {
        background-color: #F3F8FF;
        min-height: calc(100vh - 150px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        color: #1F2937;
    }
    
    .auth-alert {
        background-color: #1E3A8A;
        color: #FFFFFF;
        padding: 15px 25px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(30, 58, 138, 0.2);
        max-width: 450px;
        width: 100%;
        text-align: center;
        animation: fadeInDown 0.5s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .auth-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .auth-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
        color: #1E3A8A;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 800;
    }

    .input-group {
        margin-bottom: 20px;
        position: relative;
    }

    .input-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 0.95rem;
        color: #1F2937;
        font-weight: 600;
    }

    .input-group input[type="email"],
    .input-group input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        background: #F3F8FF;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        color: #1F2937;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .input-group input:focus {
        outline: none;
        border-color: #2563EB;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        color: #1F2937;
        font-size: 0.9rem;
    }

    .error-msg {
        color: #EF4444;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    .status-msg {
        color: #10B981;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid #10B981;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        text-align: center;
    }

    .auth-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
    }

    .auth-link {
        color: #2563EB;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s;
        font-weight: 600;
    }

    .auth-link:hover {
        color: #1E3A8A;
        text-decoration: underline;
    }

    .auth-btn {
        background: #2563EB;
        color: #FFFFFF;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
    }

    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(37, 99, 235, 0.4);
        background: #1E3A8A;
    }
</style>
@endpush

@section('content')
<div class="auth-bg">

    <div class="auth-alert">
        🏀 ¡Atención! Debes iniciar sesión para acceder a la Tienda Oficial.
    </div>

    <div class="auth-card">
        <h2 class="auth-title">Iniciar Sesión</h2>

        @if(session('status'))
            <div class="status-msg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Tu correo de jugador">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Tu contraseña">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me" style="margin: 0; cursor: pointer;">Recordarme en este dispositivo</label>
            </div>

            <div class="auth-actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button type="submit" class="auth-btn">
                    Ingresar
                </button>
            </div>
            
            <div style="text-align: center; margin-top: 25px; font-size: 0.9rem; color: #1F2937;">
                ¿Aún no tienes equipo? <a href="{{ route('register') }}" class="auth-link">Regístrate aquí</a>
            </div>
        </form>
    </div>
</div>
@endsection
