<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\TreatmentRequest;
use App\Models\Tratamiento;
use App\Models\User;
use App\Services\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TreatmentController extends Controller
{
    public function index(): View
    {
        $tratamientos = Tratamiento::query()
            ->with('patient')
            ->where('doctor_id', auth()->id())
            ->orderByDesc('fecha_creacion')
            ->paginate(15);

        return view('doctor.treatments.index', compact('tratamientos'));
    }

    public function create(PatientService $patients): View
    {
        return view('doctor.treatments.create', [
            'pacientes' => $patients->forDoctor(auth()->user()),
        ]);
    }

    public function store(TreatmentRequest $request, PatientService $patients): RedirectResponse
    {
        $data = $request->validated();
        $this->ensureOwnsPatient($data['patient_id'], $patients);

        $data['doctor_id'] = auth()->id();
        Tratamiento::query()->create($data);

        return redirect()->route('doctor.treatments.index')->with('success', 'Tratamiento creado correctamente.');
    }

    public function show(Tratamiento $treatment): View
    {
        $this->authorize('view', $treatment);

        return view('doctor.treatments.show', [
            'tratamiento' => $treatment->load(['doctor', 'patient']),
        ]);
    }

    public function edit(Tratamiento $treatment, PatientService $patients): View
    {
        $this->authorize('update', $treatment);

        return view('doctor.treatments.edit', [
            'tratamiento' => $treatment,
            'pacientes' => $patients->forDoctor(auth()->user()),
        ]);
    }

    public function update(TreatmentRequest $request, Tratamiento $treatment, PatientService $patients): RedirectResponse
    {
        $this->authorize('update', $treatment);

        $data = $request->validated();
        $this->ensureOwnsPatient($data['patient_id'], $patients);

        $data['doctor_id'] = auth()->id();
        $treatment->update($data);

        return redirect()->route('doctor.treatments.index')->with('success', 'Tratamiento actualizado correctamente.');
    }

    public function destroy(Tratamiento $treatment): RedirectResponse
    {
        $this->authorize('delete', $treatment);
        $treatment->delete();

        return redirect()->route('doctor.treatments.index')->with('success', 'Tratamiento eliminado correctamente.');
    }

    private function ensureOwnsPatient(string $patientId, PatientService $patients): void
    {
        $patient = User::query()->find($patientId);

        if (! $patient || ! $patients->owns(auth()->user(), $patient)) {
            throw ValidationException::withMessages([
                'patient_id' => 'El paciente seleccionado no pertenece a tu lista.',
            ]);
        }
    }
}
