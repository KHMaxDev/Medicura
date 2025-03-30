<?php 

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;

class CitaController extends Controller
{
    private function isValidObjectId($id)
    {
        return preg_match('/^[0-9a-fA-F]{24}$/', $id);
    }

    public function index()
    {
        $citas = Cita::all()->map(function ($cita) {
            $doctor_nombre = $this->isValidObjectId($cita->id_doctor) 
                ? Doctor::where('_id', new ObjectId($cita->id_doctor))->value('nombre') 
                : 'Unknown';

            $paciente_nombre = $this->isValidObjectId($cita->id_paciente) 
                ? Paciente::where('_id', new ObjectId($cita->id_paciente))->value('nombre') 
                : 'Unknown';

            $cita->doctor_nombre = $doctor_nombre;
            $cita->paciente_nombre = $paciente_nombre;
            return $cita;
        });

        return view('doctor-views.citas.citas-doctor', compact('citas'));
    }

    public function show(string $id)
    {
        $cita = Cita::findOrFail($id);

        $cita->doctor_nombre = $this->isValidObjectId($cita->id_doctor) 
            ? Doctor::where('_id', new ObjectId($cita->id_doctor))->value('nombre') 
            : 'Unknown';

        $cita->paciente_nombre = $this->isValidObjectId($cita->id_paciente) 
            ? Paciente::where('_id', new ObjectId($cita->id_paciente))->value('nombre') 
            : 'Unknown';

        return view('doctor-views.citas.citas-doctor-view', compact('cita'));
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

            $doctor_nombre = $this->isValidObjectId($validated['id_doctor']) 
                ? Doctor::where('_id', new ObjectId($validated['id_doctor']))->value('nombre') 
                : 'Unknown';

            $paciente_nombre = $this->isValidObjectId($validated['id_paciente']) 
                ? Paciente::where('_id', new ObjectId($validated['id_paciente']))->value('nombre') 
                : 'Unknown';

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

            return redirect()->route('citas-doctor')->with('success', 'Cita creada');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $cita = Cita::findOrFail($id);
    
        // Change variable name to match Blade's expectation ($doctores)
        $doctores = Doctor::all(); // Was "$doctors"
        $pacientes = Paciente::all();
    
        return view('doctor-views.citas.citas-doctor-edit', compact('cita', 'doctores', 'pacientes'));
    }
    public function create()
{
    // Fetch doctors and patients for dropdowns
    $doctores = Doctor::all();
    $pacientes = Paciente::all();

    return view('doctor-views.citas.citas-doctor-create', compact('doctores', 'pacientes'));
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

        $doctor_nombre = $this->isValidObjectId($request->id_doctor) 
            ? Doctor::where('_id', new ObjectId($request->id_doctor))->value('nombre') 
            : 'Unknown';

        $paciente_nombre = $this->isValidObjectId($request->id_paciente) 
            ? Paciente::where('_id', new ObjectId($request->id_paciente))->value('nombre') 
            : 'Unknown';

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

        return redirect()->route('citas-doctor')->with('success', 'Cita actualizada');
    }

    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return redirect()->route('citas-doctor')->with('success', 'Cita eliminada');
    }
}
