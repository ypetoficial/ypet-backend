<?php

namespace App\Listeners\MobileClinicEventCreated;

use App\Domains\MobileClinicEvent\Services\MobileClinicEventRuleService;
use App\Events\MobileClinicEventCreated;

class CreateMobileClinicEventRuleListener
{
    public function __construct(
        protected readonly MobileClinicEventRuleService $mobileClinicEventRuleService
    ) {}

    public function handle(MobileClinicEventCreated $event): void
    {
        $entity = $event->entity;
        $rules = data_get($event->params, 'rules', []);

        logger()->info('CreateMobileClinicEventRuleListener triggered', [
            'entity_id' => $entity->id,
            'params' => $event->params,
        ]);

        if (empty($rules)) {
            return;
        }

        foreach ($rules as $rule) {
            $rule['mobile_clinic_event_id'] = $entity->id;
            $this->mobileClinicEventRuleService->save($rule);
        }

        logger()->info('Rules created for mobile clinic event', [
            'mobile_clinic_event_id' => $entity->id,
            'rules_count' => count($rules),
        ]);
    }
}
