<?php

namespace App\Domains\Product\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\ProductBaseUnitEnum;
use App\Domains\Enums\ProductCategoryEnum;
use App\Domains\Enums\ProductUnitEnum;
use App\Domains\Enums\TargetSpeciesEnum;
use App\Models\Product;

class ProductEntity extends Product
{
    protected $table = 'products';

    protected $fillable = [
        'uuid',
        'name',
        'category',
        'manufacturer',
        'target_species',
        'unit',
        'stock',
        'has_stock_control',
        'min_stock',
        'expiration_date',
        'lot_number',
        'standard_quantity',
        'reference_weight',
        'standard_days',
        'base_unit',
        'observations',
        'status',
        'updated_by',
    ];

    protected $casts = [
        'category' => EnumCast::class.':'.ProductCategoryEnum::class,
        'target_species' => EnumCast::class.':'.TargetSpeciesEnum::class,
        'unit' => EnumCast::class.':'.ProductUnitEnum::class,
        'base_unit' => EnumCast::class.':'.ProductBaseUnitEnum::class,
        'stock' => 'integer',
        'has_stock_control' => 'boolean',
        'min_stock' => 'integer',
        'expiration_date' => 'date',
        'standard_quantity' => 'float',
        'reference_weight' => 'float',
        'standard_days' => 'integer',
        'status' => 'boolean',
    ];
}
