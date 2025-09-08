<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

class BelongsToField extends RelatedToField
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        $name ??= config('loom.components.belongs_to.name', 'belongs_to');

        if (! Str::endsWith($name, '_id')) {
            $name .= '_id';
        }

        return parent::make($name, $titleAttribute, $modifyQueryUsing, $ignoreRecord);
    }
}
