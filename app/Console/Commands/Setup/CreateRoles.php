<?php

namespace App\Console\Commands\Setup;

use App\Domains\Enums\RolesEnum;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default roles and permissions for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roles = RolesEnum::labels();

        foreach ($roles as $role) {
            if (Role::where('name', data_get($role, 'value'))->exists()) {
                $this->info("Role {$role['value']} already exists.");

                continue;
            }

            Role::create([
                'name' => data_get($role, 'value'),
                'guard_name' => 'api',
                'description' => data_get($role, 'description'),
            ]);
        }
    }
}
