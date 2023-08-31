<?php

namespace App\Traits;

use App\Tbuy\Attributable\Models\Attributable;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasExtendedName
{
    public function extendedName(): Attribute
    {
        if (!$this->relationLoaded('attributesList') || empty($this->is_extended_name)) {
            return Attribute::get(fn() => '');
        }

        $attributes = $this->attributesList->filter(fn(Attributable $attributable) => $attributable->is_name_part);
        $values = $attributes->implode(fn(Attributable $attributable) => $attributable->value, ' ');
        $name = $this->name;

        if (is_array($name)) {
            $name = implode(', ', $this->name);
        }

        $trimmed_extended_value = trim("$name $values");

        return Attribute::get(fn() => $trimmed_extended_value);
    }
}
