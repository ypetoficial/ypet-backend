<?php

namespace App\Domains\AnimalAmbulance\Services;

use Illuminate\Support\Facades\Storage;
use App\Domains\Abstracts\AbstractService;
use App\Domains\Address\Services\ReverseGeoCoderService;
use App\Domains\AnimalAmbulance\Repositories\AnimalAmbulanceRepository;
use App\Models\AnimalAmbulenceReason;
use Illuminate\Http\UploadedFile;

class AnimalAmbulanceService extends AbstractService
{
    protected ReverseGeoCoderService $reverseGeoCoderService;
    protected AnimalAmbulenceReason $animalAmbulenceReason;
    public function __construct(AnimalAmbulanceRepository $repository)
    {
        $this->repository = $repository;
        $this->reverseGeoCoderService = app(ReverseGeoCoderService::class);
        $this->animalAmbulenceReason = app(AnimalAmbulenceReason::class);
    }

    public function beforeSave(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $reason = $this->animalAmbulenceReason->find($data['reason_id']);

        if (! $reason) {
            throw new \Exception('Razão não encontrada');
        }

        $data['priority'] = $reason->priority;

        if (isset($data['evidence'])) {
            $data['evidence_path'] = $this->handleEvidence($data['evidence']);
            unset($data['evidence']);
        }

        $rawAddress = $this->reverseGeoCoderService->reverseGeoCode($data['latitude'], $data['longitude']);

        if (! $rawAddress) {
            throw new \Exception('Endereço não encontrado');
        }

        $data['raw_address'] = $rawAddress;

        return $data;
    }

    public function afterSave($entity, array $params): void
    {
       $address = $this->reverseGeoCoderService->saveTheReversedAddress(
            data_get($params, 'raw_address'),
            $this->repository->getModel()::class,
            $entity->id
        );

        if (! $address) {
            throw new \Exception('Houve um erro ao salvar o endereço, tente novamente');
        }
    }

    private function handleEvidence(UploadedFile $evidence)
    {
        $path = Storage::disk('public')->putFile('animal-ambulance', $evidence);

        return $path;
    }
}
