<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;

class OrganizationField extends RelatedToField
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        return parent::make(
            $name ?? config('loom.components.organization.name', 'organization_id'),
            $titleAttribute ?? config('loom.components.organization.title_attribute', 'name'),
            $modifyQueryUsing,
            $ignoreRecord
        )
            ->label(__('loom::components.organization'));
    }
}
