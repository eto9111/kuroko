<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'required|integer',
            'correo' => 'required|email',
            'celular' => 'required',
            'personaje_favorito' => 'required'
        ]);

        Persona::create($request->all());

        return back()->with('success', 'Datos guardados correctamente');
    }
}
