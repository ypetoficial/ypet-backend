<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Eventos existentes com novos listeners para notificações
        \App\Events\UserCreated::class => [
            \App\Listeners\Notification\SendWelcomeNotification::class,
        ],

        \App\Events\LostAnimalCreated::class => [
            \App\Listeners\Notification\SendLostAnimalNotification::class,
        ],

        \App\Events\MobileClinicEventCreated::class => [
            \App\Listeners\Notification\SendNewCastrationNotification::class,
        ],

        // Novos eventos para notificações
        \App\Events\AdoptionVisitConfirmed::class => [
            \App\Listeners\Notification\SendAdoptionVisitConfirmationNotification::class,
        ],

        \App\Events\ComplaintStatusUpdated::class => [
            \App\Listeners\Notification\SendComplaintStatusNotification::class,
        ],

        \App\Events\SamupetRequestApproved::class => [
            \App\Listeners\Notification\SendSamupetApprovalNotification::class,
        ],

        \App\Events\LostAnimalFound::class => [
            \App\Listeners\Notification\SendLostAnimalFoundNotification::class,
        ],

        \App\Events\LostAnimalClosed::class => [
            \App\Listeners\Notification\SendLostAnimalClosedNotification::class,
        ],

        \App\Events\AnimalAvailableForAdoption::class => [
            \App\Listeners\Notification\SendAnimalAdoptionNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
