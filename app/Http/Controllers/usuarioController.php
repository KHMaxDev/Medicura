<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show(string $id)
    {
        $usuarios = Usuario::findOrFail($id);
        return view('admin-views.usuarios.show', compact('usuarios'));
    }

    // Mostrar todos los registros
    public function index()
    {
        $usuarios = Usuario::all(['nombre', 'email', 'curp', '_id']);
        return view('admin-views.usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin-views.usuarios.create');
    }

    // Guardar nuevo registro
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email'  => 'required|email|unique:usuarios,email',
            'curp'   => 'required|size:18|unique:usuarios,curp'
        ]);

        Usuario::create($request->only(['nombre', 'email', 'curp']));
        return redirect()->route('usuarios.index');
    }

    // Mostrar formulario de edición
    public function edit(string $id)
    {
        $usuarios = Usuario::findOrFail($id);
        return view('admin-views.usuarios.edit', compact('usuarios'));
    }

    // Actualizar registro
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email'  => 'required|email|unique:usuarios,email,' . $id . ',_id',
            'curp'   => 'required|size:18|unique:usuarios,curp,' . $id . ',_id'
        ]);

        $usuarios = Usuario::findOrFail($id);
        $usuarios->update($request->only(['nombre', 'email', 'curp']));
        return redirect()->route('usuarios.index');
    }

    // Eliminar registro
    public function destroy(string $id)
    {
        $usuarios = Usuario::findOrFail($id);
        $usuarios->delete();
        return redirect()->route('usuarios.index') ;
    }
}