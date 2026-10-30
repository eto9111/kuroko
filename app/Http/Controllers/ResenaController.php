<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Resena;

class ResenaController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'contenido.required' => 'El campo Contenido está vacío, por favor rellénelo.',
            'contenido.min' => 'El contenido debe tener al menos 5 caracteres.',
            'rating.required' => 'El campo Calificación está vacío, por favor rellénelo.',
            'producto.required' => 'El campo Producto está vacío, por favor rellénelo.',
            'tiempo_llegada.required' => 'El campo Tiempo de llegada está vacío, por favor rellénelo.',
            'estado_paquete.required' => 'El campo Estado del paquete está vacío, por favor rellénelo.',
        ];

        $request->validate([
            'contenido' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
            'producto' => 'required|string|max:255',
            'tiempo_llegada' => 'required|string|max:100',
            'estado_paquete' => 'required|string|max:100',
        ], $messages);

        try {
            Resena::create([
                'user_id' => Auth::id(),
                'contenido' => $request->contenido,
                'rating' => $request->rating,
                'producto' => $request->producto,
                'tiempo_llegada' => $request->tiempo_llegada,
                'estado_paquete' => $request->estado_paquete,
            ]);

            return redirect()->route('dashboard')->with('success', 'Opinión publicada correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error guardando reseña: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al guardar la reseña en la base de datos.');
        }
    }

    public function edit(Resena $resena)
    {
        if (Auth::id() !== $resena->user_id) {
            return redirect()->route('dashboard')->with('error', 'No puede editar esta publicación.');
        }

        return view('resenas.edit', compact('resena'));
    }

    public function update(Request $request, Resena $resena)
    {
        if (Auth::id() !== $resena->user_id) {
            return redirect()->route('dashboard')->with('error', 'No puede actualizar esta publicación.');
        }

        $messages = [
            'contenido.required' => 'El campo Contenido está vacío, por favor rellénelo.',
            'contenido.min' => 'El contenido debe tener al menos 5 caracteres.',
            'rating.required' => 'El campo Calificación está vacío, por favor rellénelo.',
            'producto.required' => 'El campo Producto está vacío, por favor rellénelo.',
            'tiempo_llegada.required' => 'El campo Tiempo de llegada está vacío, por favor rellénelo.',
            'estado_paquete.required' => 'El campo Estado del paquete está vacío, por favor rellénelo.',
        ];

        $request->validate([
            'contenido' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
            'producto' => 'required|string|max:255',
            'tiempo_llegada' => 'required|string|max:100',
            'estado_paquete' => 'required|string|max:100',
        ], $messages);

        try {
            $resena->update($request->only(['contenido', 'rating', 'producto', 'tiempo_llegada', 'estado_paquete']));
            return redirect()->route('dashboard')->with('success', 'Publicación actualizada correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error actualizando reseña: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al actualizar la reseña en la base de datos.');
        }
    }

    public function destroy(Resena $resena)
    {
        if (Auth::id() !== $resena->user_id) {
            return redirect()->route('dashboard')->with('error', 'No puede eliminar esta publicación.');
        }

        try {
            $resena->delete();
            return redirect()->route('dashboard')->with('success', 'Publicación eliminada correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error eliminando reseña: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Error al eliminar la reseña.');
        }
    }
}
