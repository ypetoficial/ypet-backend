<?php

namespace App\Listeners\AnimalCreated;

use App\Domains\Animal\Services\AnimalStatusService;
use App\Events\AnimalCreated;
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
    public function handle(AnimalCreated $event): void
    {
        $entity = $event->entity;
        $params = $event->params;
        logger()->info('CreateAnimalStatusListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        $this->animalStatusService->save([
            'animal_id' => $entity->id,
            'status' => data_get($params, 'status'),
            'description' => data_get($params, 'description'),
            'created_by' => data_get($params, 'created_by'),
        ]);
    }
}
