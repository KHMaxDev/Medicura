<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\AppointmentRequest;
use App\Models\Cita;
use App\Models\User;
use App\Services\AppointmentService;
use App\Services\PatientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $citas = Cita::query()
            ->with('patient')
            ->where('doctor_id', auth()->id())
            ->orderByDesc('fecha')
            ->orderByDesc('hora_inicio')
            ->paginate(15);

        return view('doctor.appointments.index', compact('citas'));
    }

    public function create(PatientService $patients): View
    {
        return view('doctor.appointments.create', [
            'pacientes' => $patients->forDoctor(auth()->user()),
        ]);
    }

    public function store(
        AppointmentRequest $request,
        AppointmentService $appointments,
        PatientService $patients,
    ): RedirectResponse {
        $data = $request->validated();
        $this->ensureOwnsPatient($data['patient_id'], $patients);

        $data['doctor_id'] = auth()->id();
        $appointments->create($data);

        return redirect()->route('doctor.appointments.index')->with('success', 'Cita creada correctamente.');
    }

    public function show(Cita $appointment): View
    {
        $this->authorize('view', $appointment);

        return view('doctor.appointments.show', [
            'cita' => $appointment->load('patient'),
        ]);
    }

    public function edit(Cita $appointment, PatientService $patients): View
    {
        $this->authorize('update', $appointment);

        return view('doctor.appointments.edit', [
            'cita' => $appointment,
            'pacientes' => $patients->forDoctor(auth()->user()),
        ]);
    }

    public function update(
        AppointmentRequest $request,
        Cita $appointment,
        AppointmentService $appointments,
        PatientService $patients,
    ): RedirectResponse {
        $this->authorize('update', $appointment);

        $data = $request->validated();
        $this->ensureOwnsPatient($data['patient_id'], $patients);

        $data['doctor_id'] = auth()->id();
        $appointments->update($appointment, $data);

        return redirect()->route('doctor.appointments.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $appointment): RedirectResponse
    {
        $this->authorize('delete', $appointment);
        $appointment->delete();

        return redirect()->route('doctor.appointments.index')->with('success', 'Cita eliminada correctamente.');
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
