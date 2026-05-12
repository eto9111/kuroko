<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ==========================================
// Rutas Públicas (Originales del Proyecto)
// ==========================================

Route::get('/', function () {
    return view('inicio');
});

Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda')->middleware('auth');

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

Route::get('/comentarios', [App\Http\Controllers\FanController::class, 'comentarios']);

use App\Http\Controllers\CapituloController;
// mostrar capítulos
Route::get('/capitulos', [CapituloController::class, 'index']);
// guardar capítulos
Route::post('/capitulos', [CapituloController::class, 'store']);

use App\Http\Controllers\PersonaController;
Route::get('/personas/create', [PersonaController::class, 'create']);
Route::post('/personas', [PersonaController::class, 'store']);

// ==========================================
// Rutas Privadas (Laravel Breeze)
// ==========================================

use App\Http\Controllers\FanController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [FanController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [FanController::class, 'store']);
    Route::post('/resenas', [CapituloController::class, 'storeResena']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
