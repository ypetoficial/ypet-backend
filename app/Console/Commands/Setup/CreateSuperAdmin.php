<?php

namespace App\Console\Commands\Setup;

use App\Domains\User\Entities\UserStatusEntity;
use App\Enums\RolesEnum;
use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Console\Command;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super admin user for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', 'super.user@ypet.com')->first();

        if (! $user) {
            $user = User::create([
                'name' => 'Super User',
                'email' => 'super.user@ypet.com',
                'telephone' => '1234567890',
                'cellphone' => '0987654321',
                'password' => bcrypt('superuser123'),
                'email_verified_at' => now(),
            ]);

            UserStatusEntity::create([
                'user_id' => $user->id,
                'status' => UserStatusEnum::ACTIVE->value,
                'description' => 'Super admin user created during setup.',
            ]);

            $this->info('Super admin user created successfully.');
        }

        $roles = array_map(
            fn ($role) => data_get($role, 'value'),
            RolesEnum::labels()
        );

        $user->syncRoles($roles);
    }
}
