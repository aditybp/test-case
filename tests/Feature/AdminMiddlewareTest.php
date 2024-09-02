<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_non_admin_is_redirected_to_login()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_guest_is_redirected_to_login()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }
}
