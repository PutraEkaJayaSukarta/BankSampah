<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
        $this->get('/admin/dashboard')->assertRedirect(route('login'));
        $this->get('/superuser/dashboard')->assertRedirect(route('login'));
    }

    public function test_user_cannot_access_admin_area(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertForbidden();

        $this->actingAs($user)
            ->get('/superuser/dashboard')
            ->assertForbidden();
    }

    public function test_admin_cannot_access_superuser_area(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/superuser/dashboard')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/superuser/admins')
            ->assertForbidden();
    }

    public function test_admin_cannot_access_user_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertForbidden();
    }

    public function test_superuser_cannot_access_admin_or_user_dashboard(): void
    {
        $superuser = User::factory()->superuser()->create();

        $this->actingAs($superuser)
            ->get('/admin/dashboard')
            ->assertForbidden();

        $this->actingAs($superuser)
            ->get('/dashboard')
            ->assertForbidden();
    }

    public function test_each_role_can_access_own_dashboard(): void
    {
        $superuser = User::factory()->superuser()->create();
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($superuser)->get('/superuser/dashboard')->assertOk();
        $this->actingAs($admin)->get('/admin/dashboard')->assertOk();
        $this->actingAs($user)->get('/dashboard')->assertOk();
    }
}
