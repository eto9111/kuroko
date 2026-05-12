@extends('layouts.layout')

@push('styles')
<style>
    .auth-bg {
        background-color: #F3F8FF;
        min-height: calc(100vh - 150px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        color: #1F2937;
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

    .input-group input {
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

    .error-msg {
        color: #EF4444;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
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
    <div class="auth-card">
        <h2 class="auth-title">Crear Cuenta</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="input-group">
                <label for="name">Nombre Completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Tu nombre completo">
                @error('name')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="ejemplo@correo.com">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
                @error('password_confirmation')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-actions">
                <a href="{{ route('login') }}" class="auth-link">
                    ¿Ya tienes cuenta?
                </a>

                <button type="submit" class="auth-btn">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
