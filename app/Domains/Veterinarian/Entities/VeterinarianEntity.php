<?php

namespace App\Domains\Veterinarian\Entities;

use App\Casts\EnumCast;
use App\Domains\User\Entities\UserStatusEntity;
use App\Enums\LinkedTypeEnum;
use App\Models\User;
use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VeterinarianEntity extends Veterinarian
{
    protected $table = 'veterinarians';

    protected $fillable = [
        'hash',
        'tenant_id',
        'company_id',
        'user_id',
        'crmv',
        'profile_picture',
        'linked_institution',
        'linked_type',
        'observations',
    ];

    protected $casts = [
        'linked_type' => EnumCast::class . ':' . LinkedTypeEnum::class,
    ];

    protected $appends = [
        'can_access_castro_mobile',
        'can_apply_vaccine',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(UserStatusEntity::class, 'user_id', 'id')->latest();
    }

    public function getCanAccessCastroMobileAttribute(): bool
    {
        if (!$this->user) {
            return false;
        }

        if (!$this->user->permissions) {
            return false;
        }

        return data_get($this->user->permissions, 'can_access_castromovel') ?? false;
    }

    public function getCanApplyVaccineAttribute(): bool
    {
        if (!$this->user) {
            return false;
        }

        if (!$this->user->permissions) {
            return false;
        }

        return data_get($this->user->permissions, 'can_apply_vaccine') ?? false;
    }
}
