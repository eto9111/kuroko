<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fan;
use App\Models\Resena;
use Illuminate\Support\Facades\Log;

class FanController extends Controller
{
    public function index()
    {
        try {
            $resenas = Resena::with('user')->latest()->get();
        } catch (\Throwable $e) {
            Log::warning('No se pudieron consultar reseñas en dashboard: ' . $e->getMessage());
            $resenas = collect();
        }

        return view('dashboard', compact('resenas'));
    }

    public function comentarios()
    {
        try {
            $fans = Fan::all();
        } catch (\Throwable $e) {
            Log::warning('No se pudieron consultar fans en comentarios: ' . $e->getMessage());
            $fans = collect();
        }

        return view('comentarios', compact('fans'));
    }

    public function store(Request $request)
    {
        return redirect('/dashboard')->with('info', 'Bienvenido de vuelta');
    }

    public function edit(Fan $fan)
    {
        return view('fans.edit', compact('fan'));
    }

    public function update(Request $request, Fan $fan)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'edad' => 'required|integer|min:1',
            'personaje_favorito' => 'required|string|max:255',
            'equipo_favorito' => 'required|string|max:255',
            'motivo' => 'required|string',
        ]);

        try {
            $fan->update($request->all());
            return redirect()->route('comentarios.index')->with('success', 'Fan actualizado correctamente');
        } catch (\Throwable $e) {
            Log::error('Error actualizando fan: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar el registro en la base de datos.');
        }
    }

    public function destroy(Fan $fan)
    {
        try {
            $fan->delete();
            return redirect()->route('comentarios.index')->with('success', 'Fan eliminado correctamente');
        } catch (\Throwable $e) {
            Log::error('Error eliminando fan: ' . $e->getMessage());
            return redirect()->route('comentarios.index')->with('error', 'Error al eliminar el registro.');
        }
    }
}
