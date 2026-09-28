<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $messages = [
            'name.required' => 'El campo Nombre Completo está vacío, por favor rellénelo.',
            'name.max' => 'El Nombre Completo no puede tener más de 255 caracteres.',
            'email.required' => 'El campo Correo Electrónico está vacío, por favor rellénelo.',
            'email.email' => 'El Correo Electrónico debe ser una dirección válida.',
            'email.unique' => 'Este Correo Electrónico ya está registrado.',
            'password.required' => 'El campo Contraseña está vacío, por favor rellénelo.',
            'password.confirmed' => 'Las contraseñas no coinciden, por favor verifique que la contraseña sea la misma.',
            'password.min' => 'La contraseña no es segura, debe tener al menos 8 caracteres.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
