<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class OrganizationColumn extends NameColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string(
            'loom.components.organization.name',
            'organization'
        ).'.'.config()->string(
            'loom.components.organization.title_attribute',
            'name'
        );

        return parent::make($name)
            ->label(__('loom::components.organization'));
    }
}
