<x-mail::message>
# @if($reason === 'approved') Cuenta aprobada @else Restablece tu contraseña @endif

Hola {{ $user->nombre }},

@if($reason === 'approved')
Tu solicitud como doctor en Medicura fue aprobada. Para crear tu contraseña y comenzar a usar la plataforma, haz clic en el siguiente botón.
@else
Recibimos una solicitud para restablecer tu contraseña. Si no fuiste tú, ignora este mensaje.
@endif

<x-mail::button :url="$url">
@if($reason === 'approved') Crear mi contraseña @else Restablecer contraseña @endif
</x-mail::button>

Este enlace expira en 60 minutos y solo puede usarse una vez.

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
