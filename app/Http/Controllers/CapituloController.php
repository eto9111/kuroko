<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitulo;
use Illuminate\Support\Facades\Log;

class CapituloController extends Controller
{
    public function index()
    {
        try {
            $capitulos = Capitulo::all();
        } catch (\Throwable $e) {
            Log::warning('No se pudo consultar capítulos desde la base de datos: ' . $e->getMessage());
            $capitulos = collect();
        }

        return view('capitulos', compact('capitulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero' => 'required|integer|min:1',
            'descripcion' => 'required|string',
            'video_url' => 'required|url',
        ]);

        try {
            Capitulo::create($request->all());
            return redirect('/capitulos')->with('success', 'Capítulo guardado correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error al guardar capítulo: ' . $e->getMessage());
            return redirect('/capitulos')->with('error', 'Error al guardar el capítulo en la base de datos.');
        }
    }
}
