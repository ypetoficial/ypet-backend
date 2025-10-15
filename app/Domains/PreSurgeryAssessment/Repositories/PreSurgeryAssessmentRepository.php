<?php

namespace App\Domains\PreSurgeryAssessment\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\PreSurgeryAssessment\Entities\PreSurgeryAssessmentEntity;

class PreSurgeryAssessmentRepository extends AbstractRepository
{
    public function __construct(PreSurgeryAssessmentEntity $model)
    {
        $this->model = $model;
    }
}
