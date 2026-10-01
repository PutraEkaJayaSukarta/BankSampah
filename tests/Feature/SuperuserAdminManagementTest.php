<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperuserAdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_superuser_can_view_admin_list(): void
    {
        $superuser = User::factory()->superuser()->create();
        $admin = User::factory()->admin()->create();

        $this->actingAs($superuser)
            ->get(route('superuser.admins.index'))
            ->assertOk()
            ->assertSeeText($admin->name);
    }

    public function test_superuser_can_create_an_admin(): void
    {
        $superuser = User::factory()->superuser()->create();

        $this->actingAs($superuser)
            ->post(route('superuser.admins.store'), [
                'name' => 'Admin Baru',
                'email' => 'admin.baru@example.com',
                'password' => 'password',
            ])
            ->assertRedirect(route('superuser.admins.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'admin.baru@example.com',
            'role' => 'admin',
        ]);
    }

    public function test_admin_creation_validates_input(): void
    {
        $superuser = User::factory()->superuser()->create();

        $this->actingAs($superuser)
            ->from(route('superuser.admins.create'))
            ->post(route('superuser.admins.store'), [
                'name' => '',
                'email' => 'invalid',
                'password' => 'short',
            ])
            ->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_superuser_can_delete_an_admin(): void
    {
        $superuser = User::factory()->superuser()->create();
        $admin = User::factory()->admin()->create();

        $this->actingAs($superuser)
            ->delete(route('superuser.admins.destroy', $admin))
            ->assertRedirect(route('superuser.admins.index'));

        $this->assertDatabaseMissing('users', ['id' => $admin->id]);
    }

    public function test_superuser_cannot_be_deleted_through_admin_management(): void
    {
        $superuser = User::factory()->superuser()->create();
        $otherSuperuser = User::factory()->superuser()->create();

        $this->actingAs($superuser)
            ->delete(route('superuser.admins.destroy', $otherSuperuser))
            ->assertRedirect(route('superuser.admins.index'));

        $this->assertDatabaseHas('users', ['id' => $otherSuperuser->id]);
    }

    public function test_admin_cannot_manage_admins(): void
    {
        $admin = User::factory()->admin()->create();
        $target = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get(route('superuser.admins.index'))
            ->assertForbidden();

        $this->actingAs($admin)
            ->post(route('superuser.admins.store'), [
                'name' => 'Admin Lain',
                'email' => 'admin.lain@example.com',
                'password' => 'password',
            ])
            ->assertForbidden();

        $this->actingAs($admin)
            ->delete(route('superuser.admins.destroy', $target))
            ->assertForbidden();

        $this->assertDatabaseHas('users', ['id' => $target->id]);
    }
}
