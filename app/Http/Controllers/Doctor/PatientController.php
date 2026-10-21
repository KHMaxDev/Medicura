<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PatientService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(PatientService $patients): View
    {
        return view('doctor.patients.index', [
            'pacientes' => $patients->forDoctor(auth()->user()),
        ]);
    }

    public function search(Request $request, PatientService $patients): View
    {
        $results = new Collection;

        if ($request->filled('nombre')) {
            $validated = $request->validate([
                'nombre' => ['required', 'string', 'max:120'],
                'apellido_paterno' => ['nullable', 'string', 'max:120'],
                'apellido_materno' => ['nullable', 'string', 'max:120'],
            ]);

            $results = $patients->search(
                auth()->user(),
                $validated['nombre'],
                $validated['apellido_paterno'] ?? null,
                $validated['apellido_materno'] ?? null,
            );
        }

        return view('doctor.patients.search', compact('results'));
    }

    public function attach(User $patient, PatientService $patients): RedirectResponse
    {
        abort_unless($patient->isPatient(), 404);

        $patients->attach(auth()->user(), $patient);

        return redirect()
            ->route('doctor.patients.index')
            ->with('success', 'Paciente agregado a tu lista.');
    }

    public function detach(User $patient, PatientService $patients): RedirectResponse
    {
        abort_unless($patient->isPatient(), 404);

        $patients->detach(auth()->user(), $patient);

        return redirect()
            ->route('doctor.patients.index')
            ->with('success', 'Paciente eliminado de tu lista.');
    }
}
