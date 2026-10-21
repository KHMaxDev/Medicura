@extends('layouts.guest')

@section('title', 'Solicitud enviada | Medicura')

@section('content')
    <div class="text-center">
        <i class="ti-check-box text-success" style="font-size: 3rem;"></i>
        <h1 class="mt-3">Solicitud enviada</h1>
        <p class="text-muted">
            Gracias por registrarte en Medicura. Un administrador revisará tu información y recibirás
            un correo cuando tu cuenta sea aprobada.
        </p>
        <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
    </div>
@endsection
