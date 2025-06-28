<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Main.main');
    }

    // Procesar formulario
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // Obtenemos al usuario autenticado

            // Redirección según el rol
            if ($user->rol_usuario === 'admin') {
                return redirect()->intended('/admin');
            } elseif ($user->rol_usuario === 'user') {
                return redirect()->intended('/user');
            } else {
                Auth::logout(); // En caso de rol no permitido
                return redirect()->route('login')->with('error', 'Rol de usuario no autorizado');
            }
        }

        return back()->with('error', 'Correo o contraseña incorrectos')->withInput();
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
