<?php

namespace App\Listeners\CollaboratorUpdatedEvent;

use App\Domains\BankAccount\Entities\BankAccountEntity;
use App\Domains\BankAccount\Services\BankAccountService;
use App\Domains\Collaborator\Entities\CollaboratorEntity;
use App\Domains\Enums\BankAccountTypeEnum;
use App\Events\Collaborator\CollaboratorUpdatedEvent;
use mysql_xdevapi\Exception;

class ChangeCollaboratorBankAccountListener
{
    public function __construct(
        protected readonly BankAccountService $bankAccountService
    ) {}

    public function handle(CollaboratorUpdatedEvent $event): void
    {
        $entity = $event->collaboratorEntity;
        $params = $event->params;

        logger()->info('ChangeCollaboratorBankAccountListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        if (! data_get($params, 'bank_account_type')) {
            return;
        }

        $bankAccount = $this->bankAccountService->findByAccountable('collaborator', $entity->id);

        if (! $bankAccount) {
            match (data_get($params, 'bank_account_type')) {
                BankAccountTypeEnum::CURRENT_ACCOUNT->value => $this->createBankAccountCurrentAccount($entity, $params),
                BankAccountTypeEnum::PIX_ACCOUNT->value => $this->createBankAccountPixAccount($entity, $params),
                default => $this->fail(new Exception('Tipo de conta bancária inválido')),
            };
        }

        $this->updateBankAccount($bankAccount, $params);
    }

    private function updateBankAccount(BankAccountEntity $bankAccount, array $params): BankAccountEntity
    {
        return $this->bankAccountService->update($bankAccount->id, array_merge($bankAccount->toArray(), [
            'bank_code' => data_get($params, 'bank_account_bank_code', $bankAccount->bank_code),
            'bank_name' => data_get($params, 'bank_account_bank_name', $bankAccount->bank_name),
            'account_type' => data_get($params, 'bank_account_type', $bankAccount->account_type),
            'agency' => data_get($params, 'bank_account_agency', $bankAccount->agency),
            'account_number' => data_get($params, 'bank_account_number', $bankAccount->account_number),
            'account_holder_name' => data_get($params, 'bank_account_holder_name', $bankAccount->account_holder_name),
            'account_holder_document' => data_get($params, 'bank_account_holder_document', $bankAccount->account_holder_document),
            'pix_key' => data_get($params, 'bank_account_pix_key', $bankAccount->pix_key),
            'pix_key_type' => data_get($params, 'bank_account_pix_key_type', $bankAccount->pix_key_type),
        ]));
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
            'created_by' => data_get($params, 'created_by'),
        ]);
    }

    private function createBankAccountPixAccount(CollaboratorEntity $collaborator, array $params): BankAccountEntity
    {
        return $this->bankAccountService->save([
            'accountable_type' => 'collaborator',
            'accountable_id' => $collaborator->id,
            'account_type' => BankAccountTypeEnum::PIX_ACCOUNT->value,
            'pix_key' => data_get($params, 'bank_account_pix_key'),
            'pix_key_type' => data_get($params, 'bank_account_pix_key_type'),
            'created_by' => data_get($params, 'created_by'),
        ]);
    }
}
