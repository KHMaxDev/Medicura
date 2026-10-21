<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppointmentRequest;
use App\Models\Cita;
use App\Models\User;
use App\Services\AppointmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $citas = Cita::query()
            ->with(['doctor', 'patient'])
            ->orderByDesc('fecha')
            ->orderByDesc('hora_inicio')
            ->paginate(15);

        return view('admin.appointments.index', compact('citas'));
    }

    public function create(): View
    {
        return view('admin.appointments.create', $this->formData());
    }

    public function store(AppointmentRequest $request, AppointmentService $appointments): RedirectResponse
    {
        $appointments->create($request->validated());

        return redirect()->route('admin.appointments.index')->with('success', 'Cita creada correctamente.');
    }

    public function show(Cita $appointment): View
    {
        $this->authorize('view', $appointment);

        return view('admin.appointments.show', ['cita' => $appointment->load(['doctor', 'patient'])]);
    }

    public function edit(Cita $appointment): View
    {
        $this->authorize('update', $appointment);

        return view('admin.appointments.edit', array_merge(
            ['cita' => $appointment],
            $this->formData(),
        ));
    }

    public function update(AppointmentRequest $request, Cita $appointment, AppointmentService $appointments): RedirectResponse
    {
        $this->authorize('update', $appointment);
        $appointments->update($appointment, $request->validated());

        return redirect()->route('admin.appointments.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $appointment): RedirectResponse
    {
        $this->authorize('delete', $appointment);
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Cita eliminada correctamente.');
    }

    private function formData(): array
    {
        return [
            'doctores' => User::query()->doctors()->active()->orderBy('apellido_paterno')->get(),
            'pacientes' => User::query()->patients()->orderBy('apellido_paterno')->get(),
        ];
    }
}
