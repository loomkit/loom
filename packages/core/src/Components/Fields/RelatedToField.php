<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

class RelatedToField
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        $name ??= 'related_to';
        $related = Str::snake($name);
        if (Str::endsWith($related, '_id')) {
            $related = Str::beforeLast($related, '_id');
        }
        if (Str::endsWith($related, '_ids')) {
            $related = Str::beforeLast($related, '_ids');
        }
        $label = Str::title(Str::snake($related, ' '));
        $related = Str::camel($related);

        return Select::make(Str::snake($name))
            ->relationship($related, $titleAttribute, $modifyQueryUsing, $ignoreRecord)
            ->label(__($label));
    }
}
