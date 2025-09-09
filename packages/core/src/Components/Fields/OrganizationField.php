<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;

class OrganizationField extends RelationshipField
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        return parent::make(
            $name ?? loom()->config('components.organization.name', 'organization_id'),
            $titleAttribute ?? loom()->config('components.organization.title_attribute', 'name'),
            $modifyQueryUsing,
            $ignoreRecord
        )
            ->label(loom()->trans('components.organization'));
    }
}
