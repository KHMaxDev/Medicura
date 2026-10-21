<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterDoctorRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function show(): View
    {
        return view('auth.register');
    }

    public function register(RegisterDoctorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['contrasena'] = Hash::make($data['contrasena']);
        $data['tipo'] = User::TYPE_DOCTOR;
        $data['estatus'] = User::STATUS_PENDING;

        User::query()->create($data);

        return redirect()->route('register.success');
    }

    public function success(): View
    {
        return view('auth.registered');
    }
}
