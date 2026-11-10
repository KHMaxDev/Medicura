@extends('layouts.base')
@section('title', 'Tu espacio | Medicura')
@section('body')
<div id="demo-app" data-role="{{ $role }}"></div>
<script>window.medicuraSeed = {{ Illuminate\Support\Js::from($seed) }};</script>
@endsection
