<?php

namespace App\Listeners\SendReport;

use App\Events\ReportReceived;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReportReceivedNotificationListener implements ShouldQueue
{
    public function handle(ReportReceived $event): void
    {
        $report = $event->report;
        $user = $report->reporter;

        // Envia denúncia com a mensagem: 'Sua denúncia foi recebida e está em análise.'
    }
}
