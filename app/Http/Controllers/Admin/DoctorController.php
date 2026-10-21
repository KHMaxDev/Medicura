<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DoctorDenied;
use App\Models\User;
use App\Services\PasswordResetService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('estatus')->toString();

        $doctores = User::query()
            ->doctors()
            ->when($status, fn ($query) => $query->where('estatus', $status))
            ->orderBy('apellido_paterno')
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('admin.doctors.index', compact('doctores', 'status'));
    }

    public function pending(): View
    {
        $doctores = User::query()
            ->doctors()
            ->where('estatus', User::STATUS_PENDING)
            ->orderBy('created_at')
            ->paginate(15);

        return view('admin.doctors.pending', compact('doctores'));
    }

    public function show(User $doctor): View
    {
        abort_unless($doctor->isDoctor(), 404);

        return view('admin.doctors.show', compact('doctor'));
    }

    public function approve(User $doctor, PasswordResetService $passwordReset): RedirectResponse
    {
        abort_unless($doctor->isDoctor(), 404);
        abort_unless($doctor->estatus === User::STATUS_PENDING, 422, 'La solicitud ya fue revisada.');

        $doctor->update(['estatus' => User::STATUS_ACTIVE]);
        $passwordReset->send($doctor, 'approved');

        return redirect()
            ->route('admin.doctors.pending')
            ->with('success', 'Solicitud aprobada. Se envió un enlace para crear la contraseña.');
    }

    public function deny(User $doctor): RedirectResponse
    {
        abort_unless($doctor->isDoctor(), 404);
        abort_unless($doctor->estatus === User::STATUS_PENDING, 422, 'La solicitud ya fue revisada.');

        $doctor->update(['estatus' => User::STATUS_DENIED]);
        Mail::to($doctor->email)->queue(new DoctorDenied($doctor));

        return redirect()
            ->route('admin.doctors.pending')
            ->with('success', 'Solicitud denegada y notificada por correo.');
    }

    public function pdf()
    {
        $doctores = User::query()->doctors()->active()->orderBy('apellido_paterno')->get();

        return Pdf::loadView('pdf.doctors', compact('doctores'))
            ->setPaper('letter', 'landscape')
            ->download('doctores.pdf');
    }
}
