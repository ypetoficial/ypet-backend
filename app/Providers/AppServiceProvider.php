<?php

namespace App\Providers;

use App\Domains\Collaborator\Entities\CollaboratorEntity;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            $frontendUrl = config('app.frontend_url');
            if (! $frontendUrl) {
                throw new \Exception('Frontend URL is not configured in the application.');
            }

            if (filter_var($frontendUrl, FILTER_VALIDATE_URL) === false) {
                throw new \Exception('Invalid Frontend URL configured in the application.');
            }

            $emailUrlEncode = urlencode($user->getEmailForPasswordReset());

            return "{$frontendUrl}/reset-password?token={$token}&email={$emailUrlEncode}";
        });

        Relation::morphMap([
            'collaborator' => CollaboratorEntity::class,
        ]);
    }
}
