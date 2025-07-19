<?php

namespace App\Console\Commands\Setup;

use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up the application...');

        $this->call('app:create-roles');
        $this->call('app:create-super-admin');

        $this->info('Application setup completed successfully!');
    }
}
