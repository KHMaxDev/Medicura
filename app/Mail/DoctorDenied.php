<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DoctorDenied extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitud de registro denegada',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.doctor-denied',
            with: ['user' => $this->user],
        );
    }
}
