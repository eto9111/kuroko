<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Contacto;

class ComunidadController extends Controller
{
    public function index()
    {
        try {
            $contactos = Contacto::with('user')->latest()->paginate(10);
        } catch (\Throwable $e) {
            Log::warning('No se pudieron consultar contactos de comunidad: ' . $e->getMessage());
            $contactos = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        }

        return view('comunidad.index', compact('contactos'));
    }

    public function create()
    {
        return view('comunidad.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'El campo Nombre está vacío, por favor rellénelo.',
            'edad.required' => 'El campo Edad está vacío, por favor rellénelo.',
            'personaje_favorito.required' => 'El campo Personaje Favorito está vacío, por favor rellénelo.',
            'equipo_favorito.required' => 'El campo Equipo Favorito está vacío, por favor rellénelo.',
            'mensaje.required' => 'El campo Mensaje está vacío, por favor rellénelo.',
            'mensaje.min' => 'El Mensaje debe tener al menos 10 caracteres.',
        ];

        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|string|max:3',
            'personaje_favorito' => 'required|string|max:255',
            'equipo_favorito' => 'required|string|max:255',
            'mensaje' => 'required|string|min:10|max:1000',
        ], $messages);

        try {
            Contacto::create([
                'user_id' => Auth::id(),
                'nombre' => $request->nombre,
                'correo' => Auth::user()->email,
                'edad' => $request->edad,
                'personaje_favorito' => $request->personaje_favorito,
                'equipo_favorito' => $request->equipo_favorito,
                'mensaje' => $request->mensaje,
            ]);

            return redirect()->route('comunidad.index')->with('success', '¡Tu perfil fue agregado exitosamente! Otros usuarios pueden contactarte.');
        } catch (\Throwable $e) {
            Log::error('Error guardando contacto de comunidad: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error al guardar el perfil en la base de datos.');
        }
    }

    public function show(Contacto $contacto)
    {
        return view('comunidad.show', compact('contacto'));
    }
}
