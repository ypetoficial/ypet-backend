<?php

namespace App\Console\Commands;

use App\Domains\Vaccine\Entities\VaccineEntity;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckVaccineExpirations extends Command
{
    protected $signature = 'vaccine:check-expirations';

    protected $description = 'Verifica vacinas próximas da validade e gera alertas';

    public function handle(): void
    {
        $alertDays = 30;
        $now = Carbon::now();

        VaccineEntity::whereNotNull('expiration_date')
            ->chunk(10, function ($vaccines) use ($now, $alertDays) {
                foreach ($vaccines as $vaccine) {
                    $expiration = \Carbon\Carbon::parse($vaccine->expiration_date);
                    $diffDays = (int) $now->diffInDays($expiration, false);

                    if ($diffDays <= $alertDays && $diffDays >= 0) {
                        $vaccine->update([
                            'alert_at' => $now,
                            'alert_sent' => false,
                        ]);

                        $this->info("ALERTA: Vacina '{$vaccine->name}' vence em {$expiration->toDateString()} (faltam $diffDays dias)");
                    }
                }
            });

        $this->info('Check de vacinas finalizado.');
    }
}
