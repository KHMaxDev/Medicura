<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function store(ContactRequest $request): RedirectResponse
    {
        Mail::to(config('mail.contact_address'))->queue(new ContactMail($request->validated()));

        return back()->with('success', 'Mensaje enviado correctamente. Te responderemos pronto.');
    }
}
