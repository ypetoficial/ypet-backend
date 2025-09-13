<?php

namespace App\Domains\AdoptionVisit\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\AdoptionVisit\Entities\AdoptionVisitEntity;
use App\Enums\AdoptionVisitStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdoptionVisitRepository extends AbstractRepository
{
    public function __construct(AdoptionVisitEntity $model)
    {
        $this->model = $model;
    }

    public function all(array $params = [], array $with = [], array $options = [])
    {
        $model = $this->getModel();
        $orderByColumn = data_get($options, 'order_by.column', 'id');
        $orderByDirection = data_get($options, 'order_by.direction', 'asc');
        $perPage = data_get($options, 'per_page', 20);
        $columns = data_get($options, 'columns', '*');
        $columns = is_array($columns) ? $columns : explode(',', $columns);

        $query = $model->with($with);

        array_filter(
            $params,
            fn ($key) => in_array($key, $model->getFillable()) && ! in_array($key, ['start_date', 'date_end']),
            ARRAY_FILTER_USE_KEY
        );

        $query->when(! empty($params['citizen_name']), function ($q) use ($params) {
            $q->whereHas('citizen.user', fn ($sub) => $sub->where('name', 'like', "%{$params['citizen_name']}%")
            );
        });

        $query->when(! empty($params['animal_name']), function ($q) use ($params) {
            $q->whereHas('animal', fn ($sub) => $sub->where('name', 'like', "%{$params['animal_name']}%")
            );
        });

        $query->when(! empty($params['start_date']) || ! empty($params['date_end']), function ($q) use ($params) {
            $q->where(function ($sub) use ($params) {
                if (! empty($params['start_date'])) {
                    $sub->where('start_date', '>=', $params['start_date']);
                }
                if (! empty($params['date_end'])) {
                    $sub->where('date_end', '<=', $params['date_end']);
                }
            });
        });

        $query->when(! empty($params['status']), function ($q) use ($params) {
            $q->where('status', $params['status']);
        });

        return $query
            ->orderBy($orderByColumn, $orderByDirection)
            ->paginate($perPage, $columns)
            ->withQueryString();
    }

    public function updateStatus(int|string $id, AdoptionVisitStatus $status, ?string $newDate = null)
    {
        $visit = $this->find($id);

        if (! $visit) {
            throw new \Exception('Visita não encontrada');
        }

        $data = [
            'status' => $status->value,
            'start_date' => $newDate,
        ];

        if ($newDate === null) {
            unset($data['start_date']);
        }

        if ($visit->start_date && now()->greaterThan($visit->start_date)) {
            if (! in_array($status->value, ['concluida', 'cancelada'])) {
                throw new \Exception('Após a data da visita, só é permitido marcar como Concluída ou Cancelada.');
            }
        }

        $this->update($visit, $data);

        $user = Auth::user();

        Log::info('Transição de status de visita de adoção', [
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'timestamp' => now()->toDateTimeString(),
        ]);

        return $visit;
    }

    public function delete($id)
    {
        throw new \Exception('Visitas não podem ser excluídas, apenas transitar de status.');
    }

    public function deleteWhere($where)
    {
        throw new \Exception('Visitas não podem ser excluídas, apenas transitar de status.');
    }
}
