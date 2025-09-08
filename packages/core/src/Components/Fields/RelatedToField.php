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
        $name ??= config('loom.components.related_to.name', 'related_to');
        $related = Str::snake($name);
        if (Str::endsWith($related, '_id')) {
            $related = Str::singular(Str::beforeLast($related, '_id'));
        }
        if (Str::endsWith($related, '_ids')) {
            $related = Str::plural(Str::beforeLast($related, '_ids'));
        }
        $label = $related;
        $loomLabel = "loom::components.{$label}";
        if (__($loomLabel) !== $loomLabel) {
            $label = "loom::components.{$label}";
        } else {
            $label = Str::title($label);
        }
        $related = Str::camel($related);

        return Select::make(Str::snake($name))
            ->relationship($related, $titleAttribute, $modifyQueryUsing, $ignoreRecord)
            ->multiple($related === Str::plural($related))
            ->label(__($label));
    }
}
