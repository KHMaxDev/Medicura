<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function show(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (! Auth::attempt([
            'email' => strtolower(trim($request->string('email')->toString())),
            'password' => $request->string('contrasena')->toString(),
        ], $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Las credenciales no son correctas.']);
        }

        $request->session()->regenerate();

        /** @var User $user */
        $user = $request->user();

        if (! $user->isActive()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['email' => 'Tu cuenta aún no está activa.']);
        }

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($user->isDoctor()) {
            return redirect()->intended(route('doctor.dashboard'));
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors(['email' => 'Esta cuenta no tiene acceso al panel web.']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
