<?php

use App\Http\Controllers\CapituloController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\FanController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResenaController;
use Illuminate\Support\Facades\Route;

// ==========================================
// Rutas Públicas (Originales del Proyecto)
// ==========================================

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

// mostrar capítulos (accesible para todos)
Route::get('/capitulos', [CapituloController::class, 'index'])->name('capitulos.index');

Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda')->middleware('auth');

// ==========================================
// Rutas Privadas (Laravel Breeze)
// ==========================================

Route::middleware(['auth', 'verified'])->group(function () {
    // guardar capítulos
    Route::post('/capitulos', [CapituloController::class, 'store'])->name('capitulos.store');
    Route::get('/dashboard', [FanController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [FanController::class, 'store']);
    Route::post('/resenas', [ResenaController::class, 'store'])->name('resenas.store');
    Route::get('/resenas/{resena}/edit', [ResenaController::class, 'edit'])->name('resenas.edit');
    Route::put('/resenas/{resena}', [ResenaController::class, 'update'])->name('resenas.update');
    Route::delete('/resenas/{resena}', [ResenaController::class, 'destroy'])->name('resenas.destroy');
    Route::get('/comunidad', [ComunidadController::class, 'index'])->name('comunidad.index');
    Route::get('/comunidad/create', [ComunidadController::class, 'create'])->name('comunidad.create');
    Route::post('/comunidad', [ComunidadController::class, 'store'])->name('comunidad.store');
    Route::get('/comunidad/{contacto}', [ComunidadController::class, 'show'])->name('comunidad.show');
    Route::get('/fans/{fan}/edit', [FanController::class, 'edit'])->name('fans.edit');
    Route::put('/fans/{fan}', [FanController::class, 'update'])->name('fans.update');
    Route::delete('/fans/{fan}', [FanController::class, 'destroy'])->name('fans.destroy');
    Route::get('/comentarios', [FanController::class, 'comentarios'])->name('comentarios.index');

    // Rutas de personas (por compatibilidad con vistas existentes)
    Route::resource('personas', PersonaController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
