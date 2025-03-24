<?php

namespace App\Http\Controllers\Api;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MongoDB\BSON\ObjectId;

class CitaController extends Controller
{
    // List all appointments
    public function index()
    {
        return response()->json(Cita::all(), 200);
    }

    // Show a specific appointment
    public function show(string $id)
    {
        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json(['error' => 'Cita not found'], 404);
        }
        return response()->json($cita, 200);
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paciente' => 'required|string|size:24',
            'id_doctor' => 'required|string|size:24',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'razon' => 'required|string',
            'acciones' => 'nullable|string',
        ]);

        $acciones = $request->acciones ? array_map('trim', explode(',', $request->acciones)) : [];

        $cita = Cita::create(array_merge($validated, ['acciones' => $acciones]));
        return response()->json($cita, 201);
    }

    // Update an appointment
    public function update(Request $request, string $id)
    {
        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json(['error' => 'Cita not found'], 404);
        }

        $validated = $request->validate([
            'id_paciente' => 'required|string|size:24',
            'id_doctor' => 'required|string|size:24',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'razon' => 'required|string',
            'acciones' => 'nullable|string',
        ]);

        $acciones = $request->acciones ? array_map('trim', explode(',', $request->acciones)) : [];
        $cita->update(array_merge($validated, ['acciones' => $acciones]));
        return response()->json($cita, 200);
    }

    // Delete an appointment
    public function destroy(string $id)
    {
        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json(['error' => 'Cita not found'], 404);
        }

        $cita->delete();
        return response()->json(['message' => 'Cita deleted'], 200);
    }
}
