<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Institucion;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Obtener todas las instituciones.
     */
    public function index()
    {
        return response()->json(Institucion::all(), 200);
    }

    /**
     * Crear una nueva institución.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion.estado' => 'required|string',
            'direccion.municipio' => 'required|string',
            'direccion.ciudad' => 'required|string',
            'direccion.colonia' => 'required|string',
            'direccion.codigo_postal' => 'required|integer',
            'direccion.calle' => 'required|string',
            'direccion.numero' => 'required|string',
        ]);

        $institucion = Institucion::create($request->all());
        
        return response()->json([
            'message' => 'Institución creada exitosamente.',
            'institucion' => $institucion
        ], 201);
    }

    /**
     * Mostrar una institución específica.
     */
    public function show($id)
    {
        $institucion = Institucion::find($id);

        if (!$institucion) {
            return response()->json(['message' => 'Institución no encontrada.'], 404);
        }

        return response()->json($institucion, 200);
    }

    /**
     * Actualizar una institución.
     */
    public function update(Request $request, $id)
    {
        $institucion = Institucion::find($id);
        
        if (!$institucion) {
            return response()->json(['message' => 'Institución no encontrada.'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion.estado' => 'required|string',
            'direccion.municipio' => 'required|string',
            'direccion.ciudad' => 'required|string',
            'direccion.colonia' => 'required|string',
            'direccion.codigo_postal' => 'required|integer',
            'direccion.calle' => 'required|string',
            'direccion.numero' => 'required|string',
        ]);

        $institucion->update($request->all());

        return response()->json([
            'message' => 'Institución actualizada exitosamente.',
            'institucion' => $institucion
        ], 200);
    }

    /**
     * Eliminar una institución.
     */
    public function destroy($id)
    {
        $institucion = Institucion::find($id);

        if (!$institucion) {
            return response()->json(['message' => 'Institución no encontrada.'], 404);
        }

        $institucion->delete();

        return response()->json(['message' => 'Institución eliminada exitosamente.'], 200);
    }
}