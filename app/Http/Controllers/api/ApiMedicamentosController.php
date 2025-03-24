<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicamentos;
use Illuminate\Http\Request;

class ApiMedicamentosController extends Controller
{
    // List all Medicamentos
    public function index()
    {
        return response()->json(Medicamentos::all());
    }

    // Show a single Medicamento
    public function show($id)
    {
        $medicamento = Medicamentos::find($id);
        if (!$medicamento) {
            return response()->json(['mensaje' => 'Medicamento no encontrado'], 404);
        }
        return response()->json($medicamento);
    }

    // Store a new Medicamento
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'efectos_secundarios' => 'array',
            'interacciones' => 'array',
            'tipo' => 'required|string'
        ]);

        $medicamento = Medicamentos::create($data);
        return response()->json($medicamento, 201);
    }

    // Update an existing Medicamento
    public function update(Request $request, $id)
    {
        $medicamento = Medicamentos::find($id);
        if (!$medicamento) {
            return response()->json(['mensaje' => 'Medicamento no encontrado'], 404);
        }

        $data = $request->validate([
            'nombre' => 'string',
            'descripcion' => 'string',
            'efectos_secundarios' => 'array',
            'interacciones' => 'array',
            'tipo' => 'string'
        ]);

        $medicamento->update($data);
        return response()->json($medicamento);
    }

    // Delete a Medicamento
    public function destroy($id)
    {
        $medicamento = Medicamentos::find($id);
        if (!$medicamento) {
            return response()->json(['mensaje' => 'Medicamento no encontrado'], 404);
        }

        $medicamento->delete();
        return response()->json(['mensaje' => 'Medicamento eliminado correctamente']);
    }
}
