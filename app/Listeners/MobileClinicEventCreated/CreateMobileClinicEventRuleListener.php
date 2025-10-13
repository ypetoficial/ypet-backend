<?php

namespace App\Listeners\MobileClinicEventCreated;

use App\Domains\MobileClinicEvent\Services\MobileClinicEventRuleService;
use App\Events\MobileClinicEventCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateMobileClinicEventRuleListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public function __construct(
        protected readonly MobileClinicEventRuleService $mobileClinicEventRuleService
    ) {
        $this->onQueue('mobile-clinic-event-created');
    }

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
