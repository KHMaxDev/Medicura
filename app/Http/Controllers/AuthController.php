<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'contrasena');

        // Buscar usuario por email
        $user = User::where('email', $credentials['email'])->first();

        // Verificar si existe y la contraseña es correcta
        if ($user && Hash::check($credentials['contrasena'], $user->contrasena)) {
            Auth::login($user);

            return $user->tipo === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('doctor.dashboard');
        }

        return back()->with('error', 'Correo o contraseña incorrecta');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

