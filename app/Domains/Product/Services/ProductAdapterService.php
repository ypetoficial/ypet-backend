<?php

namespace App\Domains\Product\Services;

use App\Domains\Enums\ProductCategoryEnum;
use App\Domains\Product\Entities\ProductEntity;
use App\Domains\Vaccine\Entities\VaccineEntity;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class ProductAdapterService
{
    public function findProduct(string $category, int $id)
    {
        return match ($category) {
            ProductCategoryEnum::VACCINE->value => VaccineEntity::find($id),
            ProductCategoryEnum::MEDICATION->value,
            ProductCategoryEnum::FOOD->value,
            ProductCategoryEnum::SUPPLEMENT->value,
            ProductCategoryEnum::VERMIFUGE->value,
            ProductCategoryEnum::OTHER->value => ProductEntity::find($id),
            default => null,
        };
    }

    public function isActive($product): bool
    {
        if (! $product) {
            return false;
        }

        $attrs = (method_exists($product, 'product') && $product->product)
            ? $product->product->getAttributes()
            : $product->getAttributes();

        $status = Arr::get($attrs, 'status');

        if (is_bool($status) || is_int($status)) {
            return (bool) $status;
        }

        return in_array(strtolower((string) $status), ['active', 'true', '1']);
    }

    public function isExpired($product): bool
    {
        if (! $product) {
            return true;
        }

        $attrs = (method_exists($product, 'product') && $product->product)
            ? $product->product->getAttributes()
            : $product->getAttributes();

        $expiration = Arr::get($attrs, 'expiration_date');
        if (! $expiration) {
            return false;
        }

        $date = Carbon::parse($expiration);

        return $date->isPast();
    }

    public function hasStock($product, float $quantity): bool
    {
        if (! $product) {
            return false;
        }

        $attrs = (method_exists($product, 'product') && $product->product)
            ? $product->product->getAttributes()
            : $product->getAttributes();

        $hasControl = (bool) Arr::get($attrs, 'has_stock_control', true);
        if (! $hasControl) {
            return $quantity > 0;
        }

        $stock = (float) Arr::get($attrs, 'stock', Arr::get($attrs, 'stock_quantity', 0));

        return $stock >= $quantity && $quantity > 0;
    }

    public function getDoseReference($product): array
    {
        if (! $product) {
            return [10.0, 1.0];
        }

        $attrs = (method_exists($product, 'product') && $product->product)
            ? $product->product->getAttributes()
            : $product->getAttributes();

        $referenceWeight = (float) Arr::get($attrs, 'reference_weight', 10.0);
        $standardQuantity = (float) Arr::get($attrs, 'standard_quantity', 1.0);

        return [$referenceWeight, $standardQuantity];
    }

    public function decreaseStock($product, float $quantity): void
    {
        if (! $product) {
            return;
        }

        if (method_exists($product, 'product') && $product->product) {
            $attrs = $product->product->getAttributes();
            $hasControl = (bool) Arr::get($attrs, 'has_stock_control', true);
            if (! $hasControl) {
                return;
            }
            $current = (float) Arr::get($attrs, 'stock', Arr::get($attrs, 'stock_quantity', 0));
            $new = max(0, (int) round($current - $quantity));
            $field = array_key_exists('stock', $attrs) ? 'stock' : 'stock_quantity';
            $product->product->update([$field => $new]);

            return;
        }

        // Fallback (antigo comportamento)
        $attrs = $product->getAttributes();
        $hasControl = (bool) Arr::get($attrs, 'has_stock_control', true);
        if (! $hasControl) {
            return;
        }
        $current = (float) Arr::get($attrs, 'stock', Arr::get($attrs, 'stock_quantity', 0));
        $new = max(0, (int) round($current - $quantity));
        $field = array_key_exists('stock', $attrs) ? 'stock' : (array_key_exists('stock_quantity', $attrs) ? 'stock_quantity' : null);
        if ($field) {
            $product->update([$field => $new]);
        }
    }
}
