<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class OrganizationColumn extends RelatedToColumn
{
    public static function make(?string $name = null, ?string $titleAttribute = null): TextColumn
    {
        return parent::make(
            $name ?? config()->string('loom.components.organization.name', 'organization_id'),
            $titleAttribute
        )
            ->label(__('loom::components.organization'));
    }
}
