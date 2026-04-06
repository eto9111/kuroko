<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

use App\Http\Controllers\FanController;
Route::get('/contacto', [FanController::class, 'index']);
Route::post('/contacto', [FanController::class, 'store']);
Route::get('/capitulos', function () {
    return view('capitulos');
});
use App\Http\Controllers\CapituloController;
// mostrar capítulos
Route::get('/capitulos', [CapituloController::class, 'index']);

// guardar capítulos
Route::post('/capitulos', [CapituloController::class, 'store']);
use App\Http\Controllers\PersonaController;

Route::get('/personas/create', [PersonaController::class, 'create']);
Route::post('/personas', [PersonaController::class, 'store']);
