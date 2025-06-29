<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Ypet\Common\Enums\RoleEnum;
use App\Ypet\Common\Enums\UserTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;
    protected User $operatorUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        Role::create(['name' => RoleEnum::ADMIN->value, 'guard_name' => 'web']);
        Role::create(['name' => RoleEnum::OPERATOR->value, 'guard_name' => 'web']);

        // Create users and assign roles
        $this->adminUser = User::factory()->create(['type' => UserTypeEnum::INTERNAL])->assignRole(RoleEnum::ADMIN->value);
        $this->operatorUser = User::factory()->create(['type' => UserTypeEnum::INTERNAL])->assignRole(RoleEnum::OPERATOR->value);
    }

    public function test_admin_can_list_internal_users()
    {
        User::factory()->create(['type' => UserTypeEnum::INTERNAL]);
        User::factory()->create(['type' => UserTypeEnum::EXTERNAL]);

        $response = $this->actingAs($this->adminUser, 'sanctum')->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data.data') // admin, operator, and the one created here
            ->assertJsonPath('data.data.0.type', UserTypeEnum::INTERNAL->value);
    }

    public function test_admin_can_create_a_new_internal_user()
    {
        $userData = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'phone' => '123456789',
            'job_title' => 'Developer',
            'role' => RoleEnum::OPERATOR->value,
        ];

        $response = $this->actingAs($this->adminUser, 'sanctum')->postJson('/api/users', $userData);

        $response->assertStatus(201)
            ->assertJsonFragment(['email' => 'newuser@example.com']);

        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'type' => UserTypeEnum::INTERNAL->value,
        ]);
    }

    public function test_admin_can_show_an_internal_user()
    {
        $internalUser = User::factory()->create(['type' => UserTypeEnum::INTERNAL]);

        $response = $this->actingAs($this->adminUser, 'sanctum')->getJson("/api/users/{$internalUser->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $internalUser->id]);
    }

    public function test_admin_cannot_show_an_external_user()
    {
        $externalUser = User::factory()->create(['type' => UserTypeEnum::EXTERNAL]);

        $response = $this->actingAs($this->adminUser, 'sanctum')->getJson("/api/users/{$externalUser->id}");

        $response->assertStatus(404);
    }

    public function test_admin_can_update_an_internal_user()
    {
        $internalUser = User::factory()->create(['type' => UserTypeEnum::INTERNAL]);
        $internalUser->assignRole(RoleEnum::OPERATOR->value);

        $updateData = ['name' => 'Updated Name', 'role' => RoleEnum::ADMIN->value];

        $response = $this->actingAs($this->adminUser, 'sanctum')->putJson("/api/users/{$internalUser->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('users', ['id' => $internalUser->id, 'name' => 'Updated Name']);
        $this->assertTrue($internalUser->fresh()->hasRole(RoleEnum::ADMIN->value));
    }

    public function test_admin_can_delete_an_internal_user()
    {
        $internalUser = User::factory()->create(['type' => UserTypeEnum::INTERNAL]);

        $response = $this->actingAs($this->adminUser, 'sanctum')->deleteJson("/api/users/{$internalUser->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', ['id' => $internalUser->id]);
    }

    public function test_non_admin_user_is_forbidden()
    {
        $response = $this->actingAs($this->operatorUser, 'sanctum')->getJson('/api/users');
        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_is_unauthorized()
    {
        $response = $this->getJson('/api/users');
        $response->assertStatus(401);
    }

     public function test_store_user_fails_with_invalid_data()
    {
        $response = $this->actingAs($this->adminUser, 'sanctum')->postJson('/api/users', ['name' => 'test']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password', 'role']);
    }
}
