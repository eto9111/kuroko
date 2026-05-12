<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fan;

class FanController extends Controller
{
    public function index()
    {
        $fans = Fan::all();
        return view('dashboard', compact('fans'));
    }

    public function comentarios()
    {
        $fans = Fan::all();
        return view('comentarios', compact('fans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'edad' => 'required|integer|min:1',
            'personaje_favorito' => 'required|string|max:255',
            'equipo_favorito' => 'required|string|max:255',
            'motivo' => 'required|string',
        ]);

        Fan::create($request->all());

        return redirect('/dashboard')->with('success', '¡Información guardada exitosamente!');
    }
}
