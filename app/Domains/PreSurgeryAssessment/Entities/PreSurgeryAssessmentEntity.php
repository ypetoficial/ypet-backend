<?php

namespace App\Domains\PreSurgeryAssessment\Entities;

use App\Domains\Animal\Entities\AnimalEntity;
use App\Models\PreSurgeryAssessment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreSurgeryAssessmentEntity extends PreSurgeryAssessment
{
    protected $table = 'pre_surgery_assessments';

    protected $fillable = [
        'animal_id',
        'mucosa',
        'hydration',
        'adequate_fasting',
        'fasting_time',
        'escore_corporal',
        'heart_rate',
        'respiratory_rate',
        'abdominal_palpation',
        'abdominal_palpation_description',
        'palpation_of_lymph_nodes',
        'palpation_of_lymph_nodes_description',
        'vulvar_discharge',
        'foreskin_discharge',
        'ectopic_testicle',
        'obervations',
        'transsurgical_intercurrences',
        'measures_taken',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class);
    }
}
