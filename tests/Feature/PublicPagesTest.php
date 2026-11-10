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
        $this->get('/login')->assertOk()->assertSee('Entrar como doctor')->assertSee('Entrar como administrador')->assertDontSee('type="password"', false);
    }

    public function test_doctor_registration_page_renders(): void
    {
        $this->get('/registro')->assertRedirect('/login');
    }

    public function test_password_recovery_page_renders(): void
    {
        $this->get('/recuperar-contrasena')->assertRedirect('/login');
    }

    public function test_admin_panel_is_public_without_database(): void
    {
        config(['database.default' => 'unavailable']);
        $this->get('/admin')->assertOk()->assertViewHas('seed');
    }

    public function test_doctor_panel_is_public_without_database(): void
    {
        config(['database.default' => 'unavailable']);
        $this->get('/doctor')->assertOk()->assertViewHas('seed');
    }

    public function test_health_endpoint_returns_ok(): void
    {
        $this->getJson('/api/health')
            ->assertOk()
            ->assertJson(['status' => 'ok']);
    }
}
