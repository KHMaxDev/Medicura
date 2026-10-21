@extends('layouts.base')

@section('body-class', 'admin-body')
@section('body')
    <div class="container-scroller">
        @include('layouts.partials.admin-navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.partials.admin-sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @include('layouts.partials.alerts')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
