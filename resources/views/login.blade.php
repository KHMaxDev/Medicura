@extends('layouts.base')
@section('title', 'Elige tu espacio | Medicura')
@section('body')
<div class="entry-page">
    <header class="public-header"><a href="/" class="brand"><img class="brand-logo" src="/logo.png" alt="" width="44" height="44">medicura<span class="brand-dot">.</span></a><a class="button" href="/">← Volver al inicio</a></header>
    <main id="main" class="entry-grid">
        <section class="entry-story" data-reveal>
            <span class="pill"><span class="status-dot"></span> Un espacio para cuidar mejor</span>
            <h1>El cuidado,<br><em>conectado.</em></h1>
            <p>Menos tiempo gestionando.<br>Más tiempo para las personas.</p>
            <div class="care-art" aria-hidden="true"><div class="orbit orbit-one"></div><div class="orbit orbit-two"></div><div class="glass-cross">✚</div><div class="floating-note"><span class="icon-circle"><i data-lucide="heart-pulse"></i></span><div><strong>Todo en equilibrio</strong><small>Personas, atención y bienestar</small></div></div></div>
            <div class="story-foot"><span>Cuidado conectado</span><span>Diseñado alrededor de las personas</span></div>
        </section>
        <section class="entry-card glass" data-reveal>
            <span class="eyebrow">BIENVENIDO A MEDICURA</span><h2>Elige tu espacio</h2><p>Explora cada perspectiva de una atención más cercana.</p>
            <a class="role-card" href="/doctor"><span class="role-icon teal"><i data-lucide="stethoscope"></i></span><div><h3>Entrar como doctor</h3><p>Tus pacientes, citas y tratamientos,<br>en un mismo lugar.</p><span class="role-link">Ir a mi espacio <i data-lucide="arrow-up-right"></i></span></div></a>
            <a class="role-card" href="/admin"><span class="role-icon blue"><i data-lucide="layout-dashboard"></i></span><div><h3>Entrar como administrador</h3><p>Una visión completa de tu equipo<br>y de la operación.</p><span class="role-link">Abrir administración <i data-lucide="arrow-up-right"></i></span></div></a>
            <div class="entry-notice"><i data-lucide="sparkles"></i><span>Acceso libre · Datos de ejemplo<br>Explora, prueba y restablece cuando quieras.</span></div>
        </section>
    </main><footer class="public-footer"><span>© {{ date('Y') }} Medicura</span><span>Tecnología que acerca.</span></footer>
</div>
@endsection
