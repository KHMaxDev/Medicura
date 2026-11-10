<?php
namespace Tests\Feature;
use App\Data\DemoData;
use Tests\TestCase;

class DemoTest extends TestCase
{
    public function test_all_modules_and_browser_created_ids_render_without_a_database(): void
    {
        config(['database.default' => 'unavailable']);
        foreach (['/admin/doctors', '/admin/doctors/pending', '/admin/patients', '/admin/institutions', '/admin/medicines', '/admin/appointments', '/admin/reports', '/doctor/patients/search', '/doctor/appointments', '/doctor/medicines', '/doctor/treatments'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/doctor/treatments/browser-created-id/edit')->assertOk();
        $this->get('/admin/unknown')->assertNotFound();
        $this->get('/doctor/institutions')->assertNotFound();
        $this->get('/admin/patients/p1/bad')->assertNotFound();
    }
    public function test_demo_seed_has_consistent_relations_and_no_credentials(): void
    {
        $data = DemoData::all();
        foreach ($data['appointments'] as $appointment) {
            $this->assertContains($appointment['patient_id'], array_column($data['patients'], 'id'));
            $this->assertContains($appointment['doctor_id'], array_column($data['doctors'], 'id'));
        }
        $this->assertSame(18, count($data['patients']));
        $this->assertStringNotContainsString('password', json_encode($data));
        $this->assertStringNotContainsString('contrasena', json_encode($data));
    }
    public function test_no_auth_or_mutation_routes_remain(): void
    {
        $this->post('/login')->assertStatus(405);
        $this->post('/admin/patients')->assertStatus(405);
        $this->get('/restablecer-contrasena/1')->assertNotFound();
    }
}
