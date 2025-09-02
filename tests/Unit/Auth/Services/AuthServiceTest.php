<?php

namespace Tests\Unit\Auth\Services;

use App\Models\User;
use App\Ypet\Auth\Services\AuthService;
use App\Ypet\Common\Enums\UserStatusEnum;
use App\Ypet\User\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Mockery;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userServiceMock;

    /** @var AuthService */
    protected $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userServiceMock = Mockery::mock(UserService::class);
        $this->authService = new AuthService($this->userServiceMock);
    }

    public function test_login_successfully()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'status' => UserStatusEnum::ACTIVE->value,
        ]);

        $this->userServiceMock->shouldReceive('findByEmail')->with($user->email)->andReturn($user);

        $result = $this->authService->login(['email' => $user->email, 'password' => 'password']);

        $this->assertArrayHasKey('access_token', $result);
    }

    public function test_login_with_wrong_password()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->userServiceMock->shouldReceive('findByEmail')->with($user->email)->andReturn($user);

        $this->authService->login(['email' => $user->email, 'password' => 'wrong-password']);
    }

    public function test_login_with_non_existent_user()
    {
        $this->expectException(ValidationException::class);

        $this->userServiceMock->shouldReceive('findByEmail')->with('nonexistent@user.com')->andReturn(null);

        $this->authService->login(['email' => 'nonexistent@user.com', 'password' => 'password']);
    }

    public function test_login_with_disabled_user()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'status' => UserStatusEnum::DISABLED->value,
        ]);

        $this->userServiceMock->shouldReceive('findByEmail')->with($user->email)->andReturn($user);

        $this->authService->login(['email' => $user->email, 'password' => 'password']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
