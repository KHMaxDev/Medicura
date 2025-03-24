<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioApiController extends Controller
{
    public function index()
    {
        return response()->json(Usuario::all(['_id', 'nombre', 'email', 'curp']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'curp' => 'required|size:18|unique:usuarios,curp',
            'contrasena' => 'required|min:8'
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'curp' => $request->curp,
            'contrasena' => Hash::make($request->contrasena) // Contraseña cifrada para mas "seguridad"
        ]);

        return response()->json($usuario, 201);
    }

    public function show(Usuario $usuario)
    {
        return response()->json(['usuario' => $usuario]);
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->_id . ',_id',
            'curp' => 'required|size:18|unique:usuarios,curp,' . $usuario->_id . ',_id'
            
        ]);

        $usuario->update($request->all());
        return response()->json($usuario);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 204);
    }
}

