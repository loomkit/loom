<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class OrganizationColumn extends RelationshipColumn
{
    public static function make(?string $name = null, ?string $titleAttribute = null): TextColumn
    {
        return parent::make(
            $name ?? loom()->config('components.organization.name', 'organization_id'),
            $titleAttribute
        )
            ->label(loom()->trans('components.organization'));
    }
}
