<x-mail::message>
# Solicitud denegada

Hola {{ $user->nombre }},

Lamentamos informarte que tu solicitud de registro como doctor no fue aprobada. La información proporcionada no cumple con los requisitos establecidos.

Si consideras que se trata de un error, comunícate con nuestro equipo de soporte.

Atentamente,<br>
**{{ config('app.name') }}**
</x-mail::message>
