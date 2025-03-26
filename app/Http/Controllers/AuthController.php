<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
    
        // Convertir email a minúsculas para evitar problemas de mayúsculas/minúsculas
        $email = strtolower($credentials['email']);
    
        // Buscar usuario por email
        $user = User::where('email', Str::lower($credentials['email']))->first();
    
        if (!$user || $user->estatus !== 'activo') {
            return back()->with('error', 'Usuario no encontrado o no valido.');
        }
        
        // Verificar si la contraseña es correcta
        if (!Hash::check($credentials['contrasena'], $user->contrasena)) {
            return back()->with('error', 'Correo o contraseña incorrecta.');
        }
    
        Auth::login($user);
    
        return $user->tipo === 'admin'
            ? redirect()->route('admin')
            : redirect()->route('doctor.dashboard');
    }
    

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

