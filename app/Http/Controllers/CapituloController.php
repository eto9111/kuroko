<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitulo;

class CapituloController extends Controller
{
    // Mostrar capítulos
    public function index()
    {
        $capitulos = Capitulo::all();
        return view('capitulos', compact('capitulos'));
    }

    // Guardar capítulo
    public function store(Request $request)
    {
        Capitulo::create($request->all());
        return redirect('/capitulos');
    }
}