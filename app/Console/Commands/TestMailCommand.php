<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMailCommand extends Command
{
    protected $signature = 'mail:test {email}';

    protected $description = 'Envia um e-mail de teste via SMTP configurado';

    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Enviando e-mail de teste para: {$email}");

        try {
            Mail::raw('Teste SMTP Brevo OK ✅', function ($m) use ($email) {
                $m->to($email)->subject('Teste YPet');
            });

            $this->info('✅ E-mail enviado com sucesso!');
        } catch (\Throwable $e) {
            $this->error('❌ Erro ao enviar: '.$e->getMessage());
        }
    }
}
