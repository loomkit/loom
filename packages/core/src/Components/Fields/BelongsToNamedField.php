<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;

class BelongsToNamedField extends BelongsToField
{
    #[\Override]
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = 'name',
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        return parent::make(
            $name,
            $titleAttribute ?? config('loom.components.belongs_to_named.title_attribute', 'name'),
            $modifyQueryUsing,
            $ignoreRecord
        );
    }
}
