<?php

 namespace App\Casts;

 use App\Domains\Abstracts\EnumInterface;
 use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
 use Illuminate\Database\Eloquent\Model;
 use InvalidArgumentException;

 class EnumCast implements CastsAttributes
 {
     protected string $enumClass;

     public function __construct(string $enumClass)
     {
         if (!enum_exists($enumClass)) {
             throw new InvalidArgumentException("Class {$enumClass} is not a valid enum.");
         }
         $this->enumClass = $enumClass;
     }

     public function get(Model $model, string $key, mixed $value, array $attributes): mixed
     {
         /**
          * @var $enum EnumInterface
          */
         $enum = ($this->enumClass);

         return $value !== null ? $enum::labelByValue($value, 'pt_BR') : null;
     }

     public function set(Model $model, string $key, mixed $value, array $attributes): mixed
     {
         if ($value instanceof $this->enumClass) {
             /**
              * @var $enum EnumInterface
              */
             $enum = ($this->enumClass);

             return $enum::getByName($value->name)->value;
         }
         return $value;
     }
 }
