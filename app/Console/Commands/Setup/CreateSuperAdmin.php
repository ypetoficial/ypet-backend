<?php

namespace App\Console\Commands\Setup;

use App\Enums\RolesEnum;
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
                'name' => 'Super Admin',
                'email' => 'super.user@ypet.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $roles = array_map(
            fn ($role) => data_get($role, 'value'),
            RolesEnum::labels()
        );

        $user->syncRoles($roles);
    }
}
