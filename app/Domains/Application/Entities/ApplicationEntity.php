<?php

namespace App\Domains\Application\Entities;

use App\Casts\EnumCast;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Enums\ProductCategoryEnum;
use App\Domains\Product\Entities\ProductEntity;
use App\Domains\User\Entities\UserEntity;
use App\Models\Application;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationEntity extends Application
{
    protected $table = 'applications';

    protected $fillable = [
        'uuid',
        'animal_id',
        'product_id',
        'category',
        'application_date',
        'animal_weight',
        'estimated_days_supply',
        'responsible_user_id',
        'lot_number',
        'expiration_date',
        'supplement_type',
        'via_administration',
        'next_dose_date',
        'frequency',
        'period_days',
        'dosage_observations',
        'daily_quantity_g_per_kg',
        'meals_per_day',
        'observations',
    ];

    protected $casts = [
        'category' => EnumCast::class.':'.ProductCategoryEnum::class,
        'application_date' => 'date',
        'expiration_date' => 'date',
        'next_dose_date' => 'date',
        'animal_weight' => 'decimal:2',
        'estimated_days_supply' => 'decimal:2',
        'daily_quantity_g_per_kg' => 'decimal:3',
        'period_days' => 'integer',
        'meals_per_day' => 'integer',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class, 'animal_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductEntity::class, 'product_id');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'responsible_user_id');
    }
}
