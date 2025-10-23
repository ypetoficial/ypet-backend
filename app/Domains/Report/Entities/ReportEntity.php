<?php

namespace App\Domains\Report\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\User\Entities\UserEntity;
use App\Enums\ReportStatus;
use App\Models\Report;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class ReportEntity extends Report
{
    protected $table = 'reports';

    protected $fillable = [
        'type',
        'reporter_id',
        'description',
        'picture',
        'status',
    ];

    protected static function booted(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            if (empty($model->status)) {
                $model->status = ReportStatus::IN_REVIEW->value;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(AddressEntity::class, 'addressable');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'reporter_id', 'id');
    }
}
