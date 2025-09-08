<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;

class BelongsToOrganizationField extends BelongsToNamedField
{
    public static function make(
        ?string $name = 'organization',
        string|Closure|null $titleAttribute = 'name',
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        return parent::make(
            $name ?? config('loom.components.organization.name', 'organization'),
            $titleAttribute,
            $modifyQueryUsing,
            $ignoreRecord
        )
            ->label(__('loom::components.organization'));
    }
}
