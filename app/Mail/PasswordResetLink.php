<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetLink extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public User $user,
        public string $url,
        public string $reason = 'reset',
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->reason === 'approved'
                ? 'Tu cuenta de Medicura fue aprobada'
                : 'Restablece tu contraseña de Medicura',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.password-reset',
            with: [
                'user' => $this->user,
                'url' => $this->url,
                'reason' => $this->reason,
            ],
        );
    }
}
