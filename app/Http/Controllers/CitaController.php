<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::all()->map(function ($cita) {
            $cita->doctor_nombre = Doctor::where('_id', new ObjectId($cita->id_doctor))->value('nombre') ?? 'Unknown';
            $cita->paciente_nombre = Paciente::where('_id', new ObjectId($cita->id_paciente))->value('nombre') ?? 'Unknown';
            return $cita;
        });

        return view('admin-views.citas.citas-admin', compact('citas'));
    }

    public function create()
    {
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('admin-views.citas.citas-admin-create', compact('doctores', 'pacientes'));
    }

    public function show(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->doctor_nombre = Doctor::where('_id', new ObjectId($cita->id_doctor))->value('nombre') ?? 'Unknown';
        $cita->paciente_nombre = Paciente::where('_id', new ObjectId($cita->id_paciente))->value('nombre') ?? 'Unknown';
        return view('admin-views.citas.citas-admin-view', compact('cita'));
    }

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

        try {
            $acciones = $request->acciones 
                ? array_map('trim', explode(',', $request->acciones)) 
                : [];

            $doctor_nombre = Doctor::where('_id', new ObjectId($validated['id_doctor']))->value('nombre') ?? 'Unknown';
            $paciente_nombre = Paciente::where('_id', new ObjectId($validated['id_paciente']))->value('nombre') ?? 'Unknown';

            Cita::create([
                'id_doctor' => $validated['id_doctor'],
                'id_paciente' => $validated['id_paciente'],
                'doctor_nombre' => $doctor_nombre,
                'paciente_nombre' => $paciente_nombre,
                'fecha' => $validated['fecha'],
                'hora_inicio' => $validated['hora_inicio'],
                'hora_fin' => $validated['hora_fin'],
                'razon' => $validated['razon'],
                'acciones' => $acciones,
            ]);

            return redirect()->route('citas-admin')->with('success', 'Cita creada');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $cita = Cita::findOrFail($id);
        $doctores = Doctor::all();
        $pacientes = Paciente::all();
        return view('admin-views.citas.citas-admin-edit', compact('cita', 'doctores', 'pacientes'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_paciente' => 'required|string|size:24',
            'id_doctor' => 'required|string|size:24',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'razon' => 'required|string',
            'acciones' => 'nullable|string',
        ]);

        $cita = Cita::findOrFail($id);
        $doctor_nombre = Doctor::where('_id', new ObjectId($request->id_doctor))->value('nombre') ?? 'Unknown';
        $paciente_nombre = Paciente::where('_id', new ObjectId($request->id_paciente))->value('nombre') ?? 'Unknown';

        $acciones = $request->acciones 
            ? array_map('trim', explode(',', $request->acciones)) 
            : [];

        $cita->update([
            'id_doctor' => $request->id_doctor,
            'id_paciente' => $request->id_paciente,
            'doctor_nombre' => $doctor_nombre,
            'paciente_nombre' => $paciente_nombre,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'razon' => $request->razon,
            'acciones' => $acciones,
        ]);

        return redirect()->route('citas-admin')->with('success', 'Cita actualizada');
    }

    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return redirect()->route('citas-admin')->with('success', 'Cita eliminada');
    }
}