<?php

namespace App\Domains\Report\Entities;

use App\Enums\ReportStatus;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportEntity extends Report
{
    protected $table = 'reports';

    protected $fillable = [
        'type',
        'reporter_id',
        'location',
        'description',
        'picture',
        'status',
    ];

    protected static function booted(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) \Illuminate\Support\Str::uuid();
            if (empty($model->status)) {
                $model->status = ReportStatus::IN_REVIEW->value;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
