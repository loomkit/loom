<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

class RelatedToField extends Field
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        $name ??= Str::beforeLast(Str::afterLast(static::class, '\\'), 'Field');
        $related = Str::snake($name);
        if (Str::endsWith($related, '_id')) {
            $related = Str::singular(Str::beforeLast($related, '_id'));
        }
        if (Str::endsWith($related, '_ids')) {
            $related = Str::plural(Str::beforeLast($related, '_ids'));
        }
        $label = "loom::components.{$related}";
        if (__($label) === $label) {
            $label = Str::title($related);
        }
        $titleAttribute ??= config()->string("loom.components.{$related}.title_attribute");
        $related = Str::camel($related);

        return Select::make(Str::snake($name))
            ->relationship(
                $related,
                $titleAttribute,
                $modifyQueryUsing,
                $ignoreRecord
            )
            ->multiple($related === Str::plural($related))
            ->label(__($label));
    }
}
