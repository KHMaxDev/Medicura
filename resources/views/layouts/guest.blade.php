@extends('layouts.base')

@section('body-class', 'auth-body')
@section('body')
    <main class="auth-wrapper">
        <div class="auth-brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('favicon.svg') }}" alt="Medicura">
                <span>Medicura</span>
            </a>
        </div>

        <div class="auth-card">
            <div class="auth-card-body">
                @include('layouts.partials.alerts')
                @yield('content')
            </div>
        </div>

        <p class="auth-footer">Medicura &copy; {{ date('Y') }}</p>
    </main>
@endsection
