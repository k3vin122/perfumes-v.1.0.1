<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los campos de inicio de sesión
        $request->validate([
            'rut' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['rut' => $request->rut, 'password' => $request->password], $request->boolean('remember'))) {
            // Regenerar la sesión después de un inicio de sesión exitoso
            $request->session()->regenerate();

            // Obtener nombre del usuario para el mensaje
            $nombreUsuario = Auth::user()->name;  // O cambia 'name' por el campo correcto

            // Mensaje de bienvenida con nombre
            session()->flash('welcome', "¡Bienvenido al sistema, $nombreUsuario!");

            // Redirigir a la vista de ventas (ajusta la ruta si quieres)
            return redirect()->route('ventas.index');
        }

        // Si las credenciales no son correctas
        return back()->withErrors([
            'rut' => 'El RUT o la contraseña son incorrectos.',
        ])->onlyInput('rut');
    }


    /**
     * Log out and redirect to the login page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cerrar sesión
        Auth::guard('web')->logout();

        // Invalidar la sesión
        $request->session()->invalidate();

        // Regenerar el token de sesión
        $request->session()->regenerateToken();

        // Redirigir al login después de cerrar sesión
        return redirect()->route('login');
    }
}
