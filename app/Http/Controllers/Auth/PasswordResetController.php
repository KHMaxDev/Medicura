<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    public function requestForm(): View
    {
        return view('auth.forgot-password');
    }

    public function sendLink(Request $request, PasswordResetService $passwordReset): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()
            ->where('email', strtolower(trim((string) $request->input('email'))))
            ->where('estatus', User::STATUS_ACTIVE)
            ->first();

        if ($user) {
            $passwordReset->send($user);
        }

        return back()->with('status', 'Si el correo está registrado, recibirás un enlace para restablecer tu contraseña.');
    }

    public function resetForm(User $user): View
    {
        return view('auth.reset-password', compact('user'));
    }

    public function reset(ResetPasswordRequest $request, User $user): RedirectResponse
    {
        $user->forceFill([
            'contrasena' => Hash::make($request->validated('contrasena')),
        ])->save();

        return redirect()
            ->route('login')
            ->with('status', 'Tu contraseña fue actualizada. Ya puedes iniciar sesión.');
    }
}
