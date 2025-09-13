<?php

namespace App\Models;

use App\Common\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protector extends Model
{
    /** @use HasFactory<\Database\Factories\ProtectorFactory> */
    use HasFactory, HasUuid;
}
