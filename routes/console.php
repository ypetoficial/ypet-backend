<?php

use App\Jobs\SendCastrationReminderJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Scheduler para verificar vacinas
Schedule::command('vaccine:check-expirations')->weekly();

// Scheduler para lembretes de castração (diário às 9h)
Schedule::job(new SendCastrationReminderJob)
    ->dailyAt('09:00')
    ->name('castration-reminders')
    ->description('Enviar lembretes de castração 24h antes do evento');
