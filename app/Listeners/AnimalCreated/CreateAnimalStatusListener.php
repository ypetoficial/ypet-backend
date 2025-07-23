<?php

namespace App\Listeners\AnimalCreated;

use App\Domains\Animal\Services\AnimalStatusService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateAnimalStatusListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public function tags(): array
    {
        return [
            'CreateAnimalStatusListener',
        ];
    }

    public function __construct(
        protected readonly AnimalStatusService $animalStatusService
    ) {
        $this->onQueue('animal-created');
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $entity = $event->entity;
        $params = $event->params;
        logger()->info('CreateAnimalStatusListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        $this->animalStatusService->save([
            'user_id' => $entity->id,
            'status' => data_get($params, 'status'),
            'description' => data_get($params, 'description'),
            'created_by' => data_get($params, 'created_by'),
        ]);
    }
}
