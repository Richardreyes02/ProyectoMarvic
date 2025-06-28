<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homeUser()
    {
        $user = auth()->user();
        return view('User.home.home', compact('user'));
    }

    public function index()
    {
        $users = User::all();
        return view('Admin.Perfiles.perfiles', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed', // Recomendable mínimo 8 caracteres
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:masculino,femenino,otro',
            'cargo' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'dni_usuario' => $validated['dni'] ?? null,
            'telefono_usuario' => $validated['phone'] ?? null,
            'genero_usuario' => $validated['gender'] ?? null,
            'rol_usuario' => $validated['cargo'],
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }
}
