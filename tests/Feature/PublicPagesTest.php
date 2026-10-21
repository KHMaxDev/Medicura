<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_home_page_renders(): void
    {
        $this->get('/')->assertOk()->assertSee('Medicura');
    }

    public function test_login_page_renders(): void
    {
        $this->get('/login')->assertOk()->assertSee('Iniciar sesión');
    }

    public function test_doctor_registration_page_renders(): void
    {
        $this->get('/registro')->assertOk()->assertSee('Registro de doctor');
    }

    public function test_password_recovery_page_renders(): void
    {
        $this->get('/recuperar-contrasena')->assertOk()->assertSee('Recuperar contraseña');
    }

    public function test_admin_panel_requires_authentication(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_doctor_panel_requires_authentication(): void
    {
        $this->get('/doctor')->assertRedirect('/login');
    }

    public function test_health_endpoint_returns_ok(): void
    {
        $this->getJson('/api/health')
            ->assertOk()
            ->assertJson(['status' => 'ok']);
    }
}
