<?php

namespace App\Domains\Veterinarian\Entities;

use App\Models\User;
use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VeterinarianEntity extends Veterinarian
{
    protected $table = "veterinarians";

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
