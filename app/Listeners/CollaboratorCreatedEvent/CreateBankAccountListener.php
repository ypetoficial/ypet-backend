<?php

namespace App\Listeners\CollaboratorCreatedEvent;

use App\Domains\BankAccount\Entities\BankAccountEntity;
use App\Domains\BankAccount\Services\BankAccountService;
use App\Domains\Collaborator\Entities\CollaboratorEntity;
use App\Domains\Enums\BankAccountTypeEnum;
use App\Events\CollaboratorCreatedEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use mysql_xdevapi\Exception;

class CreateBankAccountListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;
    public function __construct(
        protected readonly BankAccountService $bankAccountService
    ) {
        $this->onQueue('collaborator-created');
    }

    public function handle(CollaboratorCreatedEvent $event): void
    {
        $entity = $event->collaboratorEntity;
        $params = $event->params;

        logger()->info('CreateBankAccountListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        match (data_get($params, 'bank_account_type')) {
            BankAccountTypeEnum::CURRENT_ACCOUNT->value => $this->createBankAccountCurrentAccount($entity, $params),
            BankAccountTypeEnum::PIX_ACCOUNT->value => $this->createBankAccountPixAccount($entity, $params),
            default => $this->fail(new Exception('Tipo de conta bancária inválido')),
        };
    }

    private function createBankAccountCurrentAccount(CollaboratorEntity $collaborator, array $params): BankAccountEntity
    {
        return $this->bankAccountService->save([
            'accountable_type' => 'collaborator',
            'accountable_id' => $collaborator->id,
            'account_type' => BankAccountTypeEnum::CURRENT_ACCOUNT->value,
            'bank_code' => data_get($params, 'bank_account_bank_code'),
            'bank_name' => data_get($params, 'bank_account_bank_name'),
            'agency' => data_get($params, 'bank_account_agency'),
            'account_number' => data_get($params, 'bank_account_number'),
            'account_holder_name' => data_get($params, 'bank_account_holder_name'),
            'account_holder_document' => data_get($params, 'bank_account_holder_document'),
            'created_by' => data_get($params, 'created_by')
        ]);
    }

    private function createBankAccountPixAccount(CollaboratorEntity $collaborator, array $params): BankAccountEntity
    {
        return $this->bankAccountService->save([
            'accountable_type' => get_class($collaborator),
            'accountable_id' => $collaborator->id,
            'account_type' => BankAccountTypeEnum::PIX_ACCOUNT->value,
            'pix_key' => data_get($params, 'bank_account_pix_key'),
            'pix_key_type' => data_get($params, 'bank_account_pix_key_type'),
            'created_by' => data_get($params, 'created_by')
        ]);
    }

    public function tags(): array
    {
        return [
            'CreateBankAccountListener',
        ];
    }
}
