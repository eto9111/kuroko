<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitulo;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;

class CapituloController extends Controller
{
    // Mostrar capítulos
    public function index()
    {
        $capitulos = Capitulo::all();
        $resenas = Resena::with('user')->get();
        return view('capitulos', compact('capitulos', 'resenas'));
    }

    // Guardar capítulo
    public function store(Request $request)
    {
        Capitulo::create($request->all());
        return redirect('/capitulos');
    }

    // Guardar reseña
    public function storeResena(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string',
        ]);

        Resena::create([
            'user_id' => Auth::id(),
            'contenido' => $request->contenido,
        ]);

        return redirect('/capitulos')->with('success_resena', 'Reseña guardada exitosamente.');
    }
}