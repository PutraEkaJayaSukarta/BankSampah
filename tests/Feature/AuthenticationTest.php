<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee(route('register'));
    }

    public function test_register_page_can_be_rendered(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertSee(route('login'));
    }

    public function test_users_can_register_and_are_redirected_to_user_dashboard(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Nasabah Baru',
            'email' => 'nasabah@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('user.dashboard'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'nasabah@example.com',
            'role' => 'user',
        ]);
    }

    public function test_registration_validates_input(): void
    {
        $this->from(route('register'))
            ->post(route('register.store'), [
                'name' => '',
                'email' => 'not-an-email',
                'password' => 'short',
                'password_confirmation' => 'different',
            ])
            ->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertGuest();
    }

    public function test_users_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'nasabah@example.com',
        ]);

        $this->post(route('login.store'), [
            'email' => 'nasabah@example.com',
            'password' => 'password',
        ])->assertRedirect(route('user.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_users_cannot_login_with_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'nasabah@example.com',
        ]);

        $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => 'nasabah@example.com',
                'password' => 'wrong-password',
            ])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_users_are_redirected_to_their_dashboard(): void
    {
        $superuser = User::factory()->superuser()->create();
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->post(route('login.store'), [
            'email' => $superuser->email,
            'password' => 'password',
        ])->assertRedirect(route('superuser.dashboard'));

        $this->post(route('logout'));

        $this->post(route('login.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->post(route('logout'));

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('user.dashboard'));
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
