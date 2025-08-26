<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        // Traemos todos los usuarios para la vista
        $usuarios = User::all();

        // Retornamos la vista con los usuarios
        return view('usuarios.index', compact('usuarios'));
    }
    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'rut' => ['required', 'string', 'max:12', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()], // Aquí está el cambio
        ]);

        $user = User::create([
            'rut' => $request->rut,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function editPassword(User $user)
    {
        if ($user->rut === '19266166-8') {
            return redirect()->back()->with('error', 'No se puede modificar la contraseña de este usuario.');
        }

        return view('usuarios.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        if ($user->rut === '19266166-8') {
            return redirect()->back()->with('error', 'No se puede modificar la contraseña de este usuario.');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('usuarios.edit-password', $user)->with('success', 'Contraseña actualizada correctamente.');
    }
}
