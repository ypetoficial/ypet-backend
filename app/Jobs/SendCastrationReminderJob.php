<?php

namespace App\Jobs;

use App\Domains\MobileClinicEvent\Entities\MobileClinicEventEntity;
use App\Domains\Notification\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendCastrationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $notificationService = app(NotificationService::class);

            // Buscar eventos para amanhã
            $tomorrow = now()->addDay()->startOfDay();
            $tomorrowEnd = now()->addDay()->endOfDay();

            Log::info('Checking for castration events tomorrow', [
                'date_start' => $tomorrow->toDateString(),
                'date_end' => $tomorrowEnd->toDateString(),
            ]);

            $events = MobileClinicEventEntity::whereBetween('start_date', [$tomorrow, $tomorrowEnd])->get();

            Log::info('Found castration events for tomorrow', [
                'count' => $events->count(),
            ]);

            foreach ($events as $event) {
                try {
                    $registrations = collect();

                    if (method_exists($event, 'registrations')) {
                        $registrations = $event->registrations()->with('user')->get();
                    } else {
                        $registrationsTable = DB::table('registrations')
                            ->where('mobile_clinic_event_id', $event->id)
                            ->where('status', 'confirmed')
                            ->get();

                        if ($registrationsTable->isNotEmpty()) {
                            $userIds = $registrationsTable->pluck('user_id')->unique();
                            $users = \App\Models\User::whereIn('id', $userIds)->get();

                            foreach ($users as $user) {
                                $registrations->push((object) ['user' => $user]);
                            }
                        }
                    }

                    if ($registrations->isEmpty()) {
                        Log::warning('No registrations found for castration event', [
                            'event_id' => $event->id,
                            'event_date' => $event->start_date ?? 'N/A',
                        ]);

                        continue;
                    }

                    Log::info('Found registrations for castration reminder', [
                        'event_id' => $event->id,
                        'registrations_count' => $registrations->count(),
                    ]);

                    foreach ($registrations as $registration) {
                        $user = $registration->user;

                        if (! $user) {
                            Log::warning('User not found for registration', [
                                'registration' => $registration,
                            ]);

                            continue;
                        }

                        try {
                            $notificationService->createAndSend([
                                'user_id' => $user->id,
                                'title' => 'Lembrete de Castração',
                                'message' => 'Você tem um agendamento de castração amanhã. Não se esqueça!',
                                'type' => 'lembrete',
                                'action_label' => 'Ver agendamento',
                                'action_target' => 'castration_schedule',
                            ]);

                            Log::info('Castration reminder sent to registered user', [
                                'user_id' => $user->id,
                                'event_id' => $event->id,
                            ]);
                        } catch (\Exception $e) {
                            Log::error('Failed to send castration reminder to registered user', [
                                'user_id' => $user->id,
                                'event_id' => $event->id,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('Error processing registrations for castration event', [
                        'event_id' => $event->id ?? null,
                        'error' => $e->getMessage(),
                    ]);

                    continue;
                }
            }

            Log::info('Castration reminder job completed', [
                'events_processed' => $events->count(),
            ]);
        } catch (\Exception $e) {
            Log::error('Castration reminder job failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
