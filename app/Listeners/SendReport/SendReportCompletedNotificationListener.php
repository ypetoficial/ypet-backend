<?php

namespace App\Listeners\SendReport;

use App\Events\ReportCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReportCompletedNotificationListener implements ShouldQueue
{
    public function handle(ReportCompleted $event): void
    {
        $report = $event->report;
        $user = $report->reporter;

        // Envia denúncia com a mensagem: 'Sua denúncia foi encerrada. Obrigado pela colaboração!'
    }
}
