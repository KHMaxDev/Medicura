<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatientRequest;
use App\Models\Cita;
use App\Models\DoctorPatient;
use App\Models\Tratamiento;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(): View
    {
        $pacientes = User::query()
            ->patients()
            ->orderBy('apellido_paterno')
            ->orderBy('nombre')
            ->paginate(15);

        return view('admin.patients.index', compact('pacientes'));
    }

    public function create(): View
    {
        return view('admin.patients.create');
    }

    public function store(PatientRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['contrasena'] = Hash::make($data['contrasena']);
        $data['tipo'] = User::TYPE_PATIENT;
        $data['estatus'] = User::STATUS_ACTIVE;

        User::query()->create($data);

        return redirect()->route('admin.patients.index')->with('success', 'Paciente registrado correctamente.');
    }

    public function show(User $patient): View
    {
        abort_unless($patient->isPatient(), 404);

        $patient->load(['appointmentsAsPatient.doctor', 'treatmentsAsPatient.doctor', 'patientLinks.doctor']);

        return view('admin.patients.show', compact('patient'));
    }

    public function edit(User $patient): View
    {
        abort_unless($patient->isPatient(), 404);

        return view('admin.patients.edit', compact('patient'));
    }

    public function update(PatientRequest $request, User $patient): RedirectResponse
    {
        abort_unless($patient->isPatient(), 404);

        $data = $request->validated();

        if (! empty($data['contrasena'])) {
            $data['contrasena'] = Hash::make($data['contrasena']);
        } else {
            unset($data['contrasena']);
        }

        $patient->update($data);

        return redirect()->route('admin.patients.show', $patient)->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(User $patient): RedirectResponse
    {
        abort_unless($patient->isPatient(), 404);

        DoctorPatient::query()->where('patient_id', $patient->getKey())->delete();
        Cita::query()->where('patient_id', $patient->getKey())->delete();
        Tratamiento::query()->where('patient_id', $patient->getKey())->delete();
        $patient->delete();

        return redirect()->route('admin.patients.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
