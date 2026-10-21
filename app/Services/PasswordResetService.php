<?php

namespace App\Services;

use App\Mail\PasswordResetLink;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PasswordResetService
{
    public function send(User $user, string $reason = 'reset'): void
    {
        $url = URL::temporarySignedRoute(
            'password.reset',
            now()->addHour(),
            ['user' => $user->getKey()],
        );

        Mail::to($user->email)->queue(new PasswordResetLink($user, $url, $reason));
    }
}
